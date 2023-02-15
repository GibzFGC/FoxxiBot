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

using Esprima.Ast;
using System.IO;
using System.Linq;
using System.Net;
using System.Net.Sockets;
using System.Threading.Tasks;

namespace FoxxiBot
{
    public class OAuth
    {
        private HttpListener listener;

        public OAuth()
        {
            listener = new HttpListener();

            if (string.IsNullOrEmpty(Config.WebserverPort))
            {
                listener.Prefixes.Add($"http://localhost:25000/");
                listener.Prefixes.Add($"http://127.0.0.1:25000/");
            } else
            {
                listener.Prefixes.Add($"http://localhost:{Config.WebserverPort}/");
                listener.Prefixes.Add($"http://127.0.0.1:{Config.WebserverPort}/");
            }
        }

        public string OauthClose()
        {
            listener.Abort();
            return "OAuth Complete, Closing...";
        }

        public async Task<Models.Authorization> Listen()
        {
            listener.Start();
            return await onRequest();
        }

        private async Task<Models.Authorization> onRequest()
        {
            while (listener.IsListening)
            {
                var ctx = await listener.GetContextAsync();
                var req = ctx.Request;
                var resp = ctx.Response;

                using (var writer = new StreamWriter(resp.OutputStream))
                {
                    if (req.QueryString.AllKeys.Any("code".Contains))
                    {
                        writer.WriteLine("Authorization started! Check your application!");
                        writer.Flush();
                        return new Models.Authorization(req.QueryString["code"]);
                    }
                    else
                    {
                        writer.WriteLine("No code found in query string!");
                        writer.Flush();
                    }
                }
            }
            return null;
        }
    }
}
