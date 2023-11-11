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

using Jint.Native;
using Newtonsoft.Json.Linq;
using System;
using System.Collections;
using System.Diagnostics;
using System.IO;
using System.Net;
using System.Runtime.InteropServices;
using System.Text;
using System.Text.RegularExpressions;
using TwitchLib.PubSub.Models.Responses;
using static System.Net.Mime.MediaTypeNames;

namespace FoxxiBot.WebServer
{
    class PHP
    {
        private string phpDir;
        public Process process;

        public PHP(string filename, string queryString, byte[] requestBody, HttpListenerContext httpListenerContext)
        {

            if (RuntimeInformation.IsOSPlatform(OSPlatform.Windows))
            {
                phpDir = AppDomain.CurrentDomain.BaseDirectory + "Binaries/php/php-cgi.exe";
            }

            if (RuntimeInformation.IsOSPlatform(OSPlatform.Linux))
            {
                phpDir = "/usr/bin/php-cgi8.1";
            }

            var documentRootPath = AppDomain.CurrentDomain.BaseDirectory + "Web/";
            var scriptFilePath = Path.GetFullPath(filename);
            var scriptFileName = Path.GetFileName(filename);
            var tempPath = Path.GetTempPath();

            process = new Process();
            process.StartInfo.FileName = this.phpDir;
            process.StartInfo.CreateNoWindow = true;
            process.StartInfo.Arguments = "-d \"display_errors=1\" -d \"error_reporting=E_PARSE\" \"" + filename + "\"";
            process.StartInfo.RedirectStandardOutput = true;
            process.StartInfo.RedirectStandardInput = true;
            process.StartInfo.RedirectStandardError = true;
            process.StartInfo.UseShellExecute = false;

            process.StartInfo.EnvironmentVariables.Clear();

            process.StartInfo.EnvironmentVariables.Add("OS_VERSION", RuntimeInformation.OSDescription);
            process.StartInfo.EnvironmentVariables.Add("DOTNET_VERSION", Environment.Version.ToString());
            process.StartInfo.EnvironmentVariables.Add("SERVER_NAME", Config.WebserverIP);
            process.StartInfo.EnvironmentVariables.Add("SERVER_PORT", Config.WebserverPort);
            process.StartInfo.EnvironmentVariables.Add("HTTP_REQUEST", httpListenerContext.Request.HttpMethod.ToString() + " " + httpListenerContext.Request.Url.PathAndQuery + " " + "HTTP/1.1");
            process.StartInfo.EnvironmentVariables.Add("HTTP_HOST", Config.WebserverIP +":" + Config.WebserverPort);
            process.StartInfo.EnvironmentVariables.Add("GATEWAY_INTERFACE", "CGI/1.1");
            process.StartInfo.EnvironmentVariables.Add("SERVER_PROTOCOL", "HTTP/1.1");
            process.StartInfo.EnvironmentVariables.Add("REDIRECT_STATUS", httpListenerContext.Response.StatusCode.ToString());
            process.StartInfo.EnvironmentVariables.Add("DOCUMENT_ROOT", documentRootPath);
            process.StartInfo.EnvironmentVariables.Add("SCRIPT_NAME", scriptFileName);
            process.StartInfo.EnvironmentVariables.Add("SCRIPT_FILENAME", scriptFilePath);
            process.StartInfo.EnvironmentVariables.Add("QUERY_STRING", queryString);
            process.StartInfo.EnvironmentVariables.Add("CONTENT_LENGTH", requestBody.Length.ToString());
            process.StartInfo.EnvironmentVariables.Add("CONTENT_TYPE", httpListenerContext.Request.ContentType);
            process.StartInfo.EnvironmentVariables.Add("REQUEST_METHOD", httpListenerContext.Request.HttpMethod);
            process.StartInfo.EnvironmentVariables.Add("USER_AGENT", httpListenerContext.Request.UserAgent.ToString());
            process.StartInfo.EnvironmentVariables.Add("SERVER_ADDR", httpListenerContext.Request.LocalEndPoint.Address.ToString());
            process.StartInfo.EnvironmentVariables.Add("REMOTE_ADDR", httpListenerContext.Request.LocalEndPoint.Address.ToString());
            process.StartInfo.EnvironmentVariables.Add("REMOTE_PORT", httpListenerContext.Request.LocalEndPoint.Port.ToString());
            process.StartInfo.EnvironmentVariables.Add("REFERER", httpListenerContext.Request.UrlReferrer?.ToString() ?? "");
            process.StartInfo.EnvironmentVariables.Add("SERVER_ADMIN", "");
            process.StartInfo.EnvironmentVariables.Add("REQUEST_URI", httpListenerContext.Request.Url.PathAndQuery.ToString());
            process.StartInfo.EnvironmentVariables.Add("HTTP_COOKIE", httpListenerContext.Request.Headers["Cookie"]);
            process.StartInfo.EnvironmentVariables.Add("HTTP_ACCEPT", httpListenerContext.Request.Headers["Accept"]);
            process.StartInfo.EnvironmentVariables.Add("HTTP_ACCEPT_CHARSET", httpListenerContext.Request.Headers["Accept-Charset"]);
            process.StartInfo.EnvironmentVariables.Add("HTTP_ACCEPT_ENCODING", httpListenerContext.Request.Headers["Accept-Encoding"]);
            process.StartInfo.EnvironmentVariables.Add("HTTP_ACCEPT_LANGUAGE", httpListenerContext.Request.Headers["Accept-Language"]);
            process.StartInfo.EnvironmentVariables.Add("TMPDIR", tempPath);
            process.StartInfo.EnvironmentVariables.Add("TEMP", tempPath);
        }

        public void getPHPOutput(string filePath, byte[] requestBody, HttpListenerContext httpListenerContext, HttpListenerResponse httpListenerResponse)
        {

            process.Start();

            var index = httpListenerContext.Request.RawUrl.IndexOf("?");

            // Write request body to standard input, for POST data
            using (var sw = process.StandardInput)
                sw.BaseStream.Write(requestBody, 0, requestBody.Length);

            // Write headers and content to response stream
            var headersEnd = false;
            using (var sr = process.StandardOutput)
            using (var output = httpListenerContext.Response.OutputStream)
            {
                string line;
                while ((line = sr.ReadLine()) != null)
                {
                    if (!headersEnd)
                    {
                        if (line == "")
                        {
                            headersEnd = true;
                            continue;
                        }

                        // The first few lines are the headers, with a
                        // key and a value. Catch those, to write them
                        // into our response headers.
                        index = line.IndexOf(':');
                        var name = line.Substring(0, index);
                        var value = line.Substring(index + 2);

                        httpListenerContext.Response.Headers.Add(name + ":" + value);
                    }
                    else
                    {
                        httpListenerResponse.ContentType = "text/html";

                        byte[] response = Encoding.UTF8.GetBytes(line + Environment.NewLine);
                        httpListenerResponse.OutputStream.WriteAsync(response, 0, response.Length);
                    }
                }
            }

            httpListenerContext.Response.Close();
            httpListenerResponse.Close();

            process.WaitForExit();
            process.Close();
        }

    }
}