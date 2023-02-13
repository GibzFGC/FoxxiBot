// Copyright(C) 2020 - 2022 FoxxiBot
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.IO;
using System.Net;
using System.Net.Sockets;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace FoxxiBot.WebServer
{

    public class WebServer : IDisposable
    {
        private object _LockObjectDispose = new object();
        private CancellationTokenSource _CancellationTokenSourceDisposed = new CancellationTokenSource();
        private readonly string[] _IndexFiles = {
            "index.html",
            "index.htm",
            "index.htmx",
            "default.html",
            "default.htm",
            "default.htmx",
            "index.php",
            "default.php"
        };

        private static IDictionary<string, string> _MimeTypeMappings = new Dictionary<string, string>(StringComparer.InvariantCultureIgnoreCase) {
            #region extension to MIME type list
            {".asf", "video/x-ms-asf"},
            {".asx", "video/x-ms-asf"},
            {".avi", "video/x-msvideo"},
            {".bin", "application/octet-stream"},
            {".cco", "application/x-cocoa"},
            {".crt", "application/x-x509-ca-cert"},
            {".css", "text/css"},
            {".deb", "application/octet-stream"},
            {".der", "application/x-x509-ca-cert"},
            {".dll", "application/octet-stream"},
            {".dmg", "application/octet-stream"},
            {".ear", "application/java-archive"},
            {".eot", "application/octet-stream"},
            {".exe", "application/octet-stream"},
            {".flv", "video/x-flv"},
            {".gif", "image/gif"},
            {".hqx", "application/mac-binhex40"},
            {".htc", "text/x-component"},
            {".htm", "text/html"},
            {".html", "text/html"},
            {".htmx", "text/html"},
            {".ico", "image/x-icon"},
            {".img", "application/octet-stream"},
            {".iso", "application/octet-stream"},
            {".jar", "application/java-archive"},
            {".jardiff", "application/x-java-archive-diff"},
            {".jng", "image/x-jng"},
            {".jnlp", "application/x-java-jnlp-file"},
            {".jpeg", "image/jpeg"},
            {".jpg", "image/jpeg"},
            {".js", "application/x-javascript"},
            {".json", "application/json"},
            {".mml", "text/mathml"},
            {".mng", "video/x-mng"},
            {".mov", "video/quicktime"},
            {".mp3", "audio/mpeg"},
            {".mpeg", "video/mpeg"},
            {".mpg", "video/mpeg"},
            {".msi", "application/octet-stream"},
            {".msm", "application/octet-stream"},
            {".msp", "application/octet-stream"},
            {".pdb", "application/x-pilot"},
            {".pdf", "application/pdf"},
            {".pem", "application/x-x509-ca-cert"},
            {".pl", "application/x-perl"},
            {".pm", "application/x-perl"},
            {".php", "application/x-httpd-php" },
            {".png", "image/png"},
            {".prc", "application/x-pilot"},
            {".ra", "audio/x-realaudio"},
            {".rar", "application/x-rar-compressed"},
            {".rpm", "application/x-redhat-package-manager"},
            {".rss", "text/xml"},
            {".run", "application/x-makeself"},
            {".sea", "application/x-sea"},
            {".shtml", "text/html"},
            {".sit", "application/x-stuffit"},
            {".swf", "application/x-shockwave-flash"},
            {".tcl", "application/x-tcl"},
            {".tk", "application/x-tcl"},
            {".txt", "text/plain"},
            {".war", "application/java-archive"},
            {".wbmp", "image/vnd.wap.wbmp"},
            {".wmv", "video/x-ms-wmv"},
            {".xml", "text/xml"},
            {".xpi", "application/x-xpinstall"},
            {".zip", "application/zip"},
            #endregion
        };
        private Thread _ServerThread;
        private string _RootDirectory;
        private bool _AllowCors;
        private int _Port;
        private Action<Exception> _HandleException;

        public int Port { get { return _Port; } }
        public string RootDirectory { get { return _RootDirectory; } }
        public WebServer(string directoryPath, int port, bool allowCors = true, Action<Exception> handleException = null)
        {
            Initialize(directoryPath, port, allowCors, handleException);
        }

        public WebServer(string directoryPath, bool allowCors = true, Action<Exception> handleException = null)
        {
            Initialize(directoryPath, GetEmptyPort(), allowCors, handleException);
        }

        private void Initialize(string path, int port, bool allowCors, Action<Exception> handleException)
        {
            _RootDirectory = path;
            _Port = port;
            _AllowCors = allowCors;
            _HandleException = handleException;
            _ServerThread = new Thread(Listen);
            _ServerThread.Start();
        }
        public void Dispose()
        {
            lock (_LockObjectDispose)
            {
                if (_CancellationTokenSourceDisposed.IsCancellationRequested) return;
                _CancellationTokenSourceDisposed.Cancel();
            }
        }

        private void Listen()
        {
            using (HttpListener httpListener = new HttpListener())
            {

                httpListener.Prefixes.Add($"http://localhost:{_Port.ToString()}/");
                httpListener.Prefixes.Add($"http://127.0.0.1:{_Port.ToString()}/");

                if (Config.WebserverIP != "" && Config.WebserverIP != null)
                {
                    httpListener.Prefixes.Add($"http://{Config.WebserverIP}:{_Port.ToString()}/");
                }

                httpListener.Start();

                using CancellationTokenRegistration cancellationTokenRegistration = _CancellationTokenSourceDisposed.Token.Register(
                        httpListener.Abort);
                while (!_CancellationTokenSourceDisposed.IsCancellationRequested)
                {
                    try
                    {
                        //Using this method because the GetContext method will not exit cleanly even when Stop or Abort are called.
                        Task<HttpListenerContext> task = httpListener.GetContextAsync();
                        task.Wait(_CancellationTokenSourceDisposed.Token);
                        Process(task.Result);
                    }
                    catch (Exception ex)
                    {
                        _HandleException?.Invoke(ex);
                    }
                }
            }
        }

        private int GetEmptyPort()
        {

            TcpListener tcpListener = new TcpListener(IPAddress.Loopback, 0);
            int port;
            tcpListener.Start();
            try
            {
                port = ((IPEndPoint)tcpListener.LocalEndpoint).Port;
            }
            finally
            {
                tcpListener.Stop();
            }
            return port;
        }

        private void Process(HttpListenerContext httpListenerContext)
        {
            HttpListenerResponse httpListenerResponse = httpListenerContext.Response;
            string fileName = null;
            try
            {
                fileName = GetRequestedFileName(httpListenerContext.Request);
                string filePath = fileName == null ? null : Path.Combine(_RootDirectory, fileName);

                // For Path / File Testing
                if (Config.Debug == true)
                {
                    Console.WriteLine("File Path: " + filePath + "\nFile Name: " + fileName + "\nDirectory: " + _RootDirectory);
                }

                if (filePath == null || !File.Exists(filePath))
                {
                    httpListenerResponse.StatusCode = (int)HttpStatusCode.NotFound;
                    return;
                }

                ReturnFile(filePath, httpListenerContext);
            }
            catch (Exception ex)
            {
                httpListenerResponse.StatusCode = (int)HttpStatusCode.InternalServerError;
                string errorMessage = $"Error processing request";
                if (fileName != null) errorMessage += $" for file \"{fileName}\"";
                throw new Exception(errorMessage, ex);
            }
            finally
            {
                fileName = GetRequestedFileName(httpListenerContext.Request);
                string filePath = fileName == null ? null : Path.Combine(_RootDirectory, fileName);

                // For Path / File Testing
                if (Config.Debug == true)
                {
                    Console.WriteLine("File Path: " + filePath + "\nFile Name: " + fileName + "\nDirectory: " + _RootDirectory);
                }

                httpListenerResponse.OutputStream.Close();
            }
        }

        private void ReturnFile(string filePath, HttpListenerContext httpListenerContext)
        {

            if (GetContentType(filePath) == "application/x-httpd-php")
            {

                HttpListenerResponse httpListenerResponse = httpListenerContext.Response;

                // Get query string from URL
                var index = httpListenerContext.Request.RawUrl.IndexOf("?");
                var queryString = index == -1 ? "" : httpListenerContext.Request.RawUrl.Substring(index + 1);

                // Read body for POST requests
                byte[] requestBody;
                using (var ms = new MemoryStream())
                {
                    httpListenerContext.Request.InputStream.CopyTo(ms);
                    requestBody = ms.ToArray();
                }

                // View Headers (For Testing)
                // Console.WriteLine(Encoding.UTF8.GetString(requestBody));

                if (_AllowCors)
                    AddCorsHeaders(httpListenerResponse);

                PHP php = new PHP(filePath, queryString, requestBody, httpListenerContext);
                php.getPHPOutput(filePath, requestBody, httpListenerContext, httpListenerResponse);
            }
            else
            {

                using (Stream input = new FileStream(filePath, FileMode.Open))
                {
                    HttpListenerResponse httpListenerResponse = httpListenerContext.Response;
                    httpListenerResponse.ContentType = GetContentType(filePath);
                    httpListenerResponse.ContentLength64 = input.Length;
                    httpListenerResponse.AddHeader("Date", DateTime.Now.ToString("r"));
                    httpListenerResponse.AddHeader("Last-Modified", System.IO.File.GetLastWriteTime(filePath).ToString("r"));

                    if (_AllowCors)
                        AddCorsHeaders(httpListenerResponse);
                    WriteInputStreamToResponse(input, httpListenerResponse.OutputStream);
                    httpListenerResponse.StatusCode = (int)HttpStatusCode.OK;
                    httpListenerResponse.OutputStream.Flush();
                }
            }
        }

        private void AddCorsHeaders(HttpListenerResponse httpListenerResponse)
        {
            httpListenerResponse.AddHeader("Access-Control-Allow-Origin", "*");
        }

        private string GetRequestedFileName(HttpListenerRequest httpListenerRequest)
        {

            string fileName = httpListenerRequest.Url.AbsolutePath.Substring(1);
            if (string.IsNullOrEmpty(fileName))
                fileName = GetExistingIndexFileName();
            return fileName;
        }

        private void WriteInputStreamToResponse(Stream inputStream, Stream outputStream)
        {

            byte[] buffer = new byte[1024 * 16];
            int nbytes;
            while ((nbytes = inputStream.Read(buffer, 0, buffer.Length)) > 0)
                outputStream.Write(buffer, 0, nbytes);
        }

        private string GetContentType(string filePath)
        {
            string mime;
            if (_MimeTypeMappings.TryGetValue(Path.GetExtension(filePath), out mime))
                return mime;
            return "application/octet-stream";
        }

        private string GetExistingIndexFileName()
        {
            foreach (string indexFile in _IndexFiles)
            {
                if (File.Exists(Path.Combine(_RootDirectory, indexFile)))
                {
                    return indexFile;
                }
            }
            return null;
        }
    }
}