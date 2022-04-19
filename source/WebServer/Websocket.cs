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
using System.Net;
using System.Net.WebSockets;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Web;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;
using System.Data.SQLite;
using FoxxiBot.TwitchBot;
using TwitchLib.Api;
using FoxxiBot;
using System.Collections.Generic;
using Discord.Commands;
using Discord.WebSocket;

public class Websocket
{

    public async void Start()
    {
        HttpListener httpListener = new HttpListener();
        httpListener.Prefixes.Add($"http://localhost:24000/");
        httpListener.Start();

        while (true)
        {
            HttpListenerContext httpListenerContext = await httpListener.GetContextAsync();
            if (httpListenerContext.Request.IsWebSocketRequest)
            {
                ProcessRequest(httpListenerContext);
            }
            else
            {
                httpListenerContext.Response.StatusCode = 400;
                httpListenerContext.Response.Close();
            }
        }
    }


    private async void ProcessRequest(HttpListenerContext httpListenerContext)
    {
        WebSocketContext webSocketContext = null;
        try
        {
            webSocketContext = await httpListenerContext.AcceptWebSocketAsync(subProtocol: null);
            string ipAddress = httpListenerContext.Request.RemoteEndPoint.Address.ToString();
        }
        catch (Exception e)
        {
            httpListenerContext.Response.StatusCode = 500;
            httpListenerContext.Response.Close();
            Console.WriteLine("Exception: {0}", e);
            return;
        }

        WebSocket webSocket = webSocketContext.WebSocket;
        try
        {

            byte[] receiveBuffer = new byte[1024];
            while (webSocket.State == WebSocketState.Open)
            {
                WebSocketReceiveResult receiveResult = await webSocket.ReceiveAsync(new ArraySegment<byte>(receiveBuffer), CancellationToken.None);
                if (receiveResult.MessageType == WebSocketMessageType.Close)
                    await webSocket.CloseAsync(WebSocketCloseStatus.NormalClosure, "", CancellationToken.None);
                else
                {

                    // Get decrypted string
                    var command = Encoding.UTF8.GetString(receiveBuffer);

                    int resultIndex = command.IndexOf(" end");
                    if (resultIndex != -1)
                    {
                        command = command.Substring(0, resultIndex);
                    }
                    
                    // Final string for command
                    var clean_string = command.Replace("\0", "");

                    // split into args
                    var split = clean_string.Split(" ");
                    // Console.WriteLine(split[0]);

                    switch (split[0])
                    {
                        // SQLite
                        case "GetDBValues":
                            GetDBValues(webSocketContext, command).GetAwaiter().GetResult();
                            break;
                        
                        case "DeleteDBRow":
                            DeleteDBRow(webSocketContext, command).GetAwaiter().GetResult();
                            break;

                        // Twitch
                        case "GetStreamNotifications":
                            GetStreamNotifications(webSocketContext).GetAwaiter().GetResult();
                            break;

                        case "GetStreamGame":
                            GetStreamGame(webSocketContext).GetAwaiter().GetResult();
                            break;

                        case "GetStreamStatus":
                            GetStreamStatus(webSocketContext).GetAwaiter().GetResult();
                            break;

                        // Discord


                        // CPU & RAM
                        case "GetCPUUsage":
                            GetCPUUsage(webSocketContext).GetAwaiter().GetResult();
                            break;

                        case "GetRAMUsage":
                            GetRAMUsage(webSocketContext).GetAwaiter().GetResult();
                            break;
                    }

                    // KEEP OFF UNLESS TESTING!
                    // await webSocket.SendAsync(new ArraySegment<byte>(receiveBuffer, 0, receiveResult.Count), WebSocketMessageType.Text, receiveResult.EndOfMessage, CancellationToken.None);
                    // Console.WriteLine("WebSocket: Sending " + Encoding.UTF8.GetString(receiveBuffer));
                }
            }
        }
        catch (Exception e)
        {
            if (Config.Debug == "true")
            {
                Console.WriteLine("Exception: {0}", e);
            }
        }
        finally
        {
            if (webSocket != null)
                webSocket.Dispose();
        }
    }

    // Socket Handling from Here!
    static async Task GetDBValues(WebSocketContext socket, string command)
    {
        // Split into Args
        var split = command.Split(" ");

        // Set a JSON Array
        JArray array = new JArray();

        // Read SQL Table
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        using var con = new SQLiteConnection(cs);
        con.Open();

        string stm = $"SELECT * FROM {split[1]}";

        using var cmd = new SQLiteCommand(stm, con);
        int row_count = Convert.ToInt32(cmd.ExecuteScalar());

        using SQLiteDataReader rdr = cmd.ExecuteReader();

        if (rdr.HasRows == true)
        {

            while (rdr.Read())
            {

                var columns = rdr.FieldCount;

                if (columns == 1) {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() }
                    });
                }

                if (columns == 2)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() }
                    });
                }

                if (columns == 3)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() }
                    });
                }

                if (columns == 4)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() }
                    });
                }

                if (columns == 5)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() }
                    });
                }

                if (columns == 6)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() },
                        { rdr.GetName(5), rdr[rdr.GetName(5)].ToString() }
                    });
                }

                if (columns == 7)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() },
                        { rdr.GetName(5), rdr[rdr.GetName(5)].ToString() },
                        { rdr.GetName(6), rdr[rdr.GetName(6)].ToString() }
                    });
                }

                if (columns == 8)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() },
                        { rdr.GetName(5), rdr[rdr.GetName(5)].ToString() },
                        { rdr.GetName(6), rdr[rdr.GetName(6)].ToString() },
                        { rdr.GetName(7), rdr[rdr.GetName(7)].ToString() }
                    });
                }

                if (columns == 9)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() },
                        { rdr.GetName(5), rdr[rdr.GetName(5)].ToString() },
                        { rdr.GetName(6), rdr[rdr.GetName(6)].ToString() },
                        { rdr.GetName(7), rdr[rdr.GetName(7)].ToString() },
                        { rdr.GetName(8), rdr[rdr.GetName(8)].ToString() }
                    });
                }

                if (columns == 10)
                {
                    array.Add(new JObject()
                    {
                        { rdr.GetName(0), rdr[rdr.GetName(0)].ToString() },
                        { rdr.GetName(1), rdr[rdr.GetName(1)].ToString() },
                        { rdr.GetName(2), rdr[rdr.GetName(2)].ToString() },
                        { rdr.GetName(3), rdr[rdr.GetName(3)].ToString() },
                        { rdr.GetName(4), rdr[rdr.GetName(4)].ToString() },
                        { rdr.GetName(5), rdr[rdr.GetName(5)].ToString() },
                        { rdr.GetName(6), rdr[rdr.GetName(6)].ToString() },
                        { rdr.GetName(7), rdr[rdr.GetName(7)].ToString() },
                        { rdr.GetName(8), rdr[rdr.GetName(8)].ToString() },
                        { rdr.GetName(9), rdr[rdr.GetName(9)].ToString() }
                    });
                }

            }

        }

        con.Close();

        // Grab JSON
        JObject o = new JObject();
        o["data"] = array;

        // Send back data
        var message = o.ToString();
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

    static Task DeleteDBRow(WebSocketContext socket, string command)
    {
        // Split into Args
        var split = command.Split(" ");

        // Delete the SQL Row
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";
        using var con = new SQLiteConnection(cs);
        con.Open();
        
        string stm = "DELETE FROM " + split[1] + " WHERE id= " + split[2] + "";
        using var cmd = new SQLiteCommand(stm, con);

        cmd.ExecuteNonQuery();
        cmd.Dispose();

        con.Close();
        return Task.CompletedTask;
    }

    static async Task GetCPUUsage(WebSocketContext socket)
    {
        FoxxiBot.Class.SystemInfo SysInfo = new FoxxiBot.Class.SystemInfo();
        var data = await SysInfo.GetCPUUsage();

        // Set a JSON Array
        JArray array = new JArray();

        // Encode as JSON
        array.Add(new JObject()
        {
            { "cpu_usage", data.ToString() }
        });

        JObject o = new JObject();
        o["data"] = array;

        // Send back data
        var message = o.ToString();
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

    static async Task GetRAMUsage(WebSocketContext socket)
    {
        FoxxiBot.Class.SystemInfo SysInfo = new FoxxiBot.Class.SystemInfo();
        var data = await SysInfo.getAvailableRAM();

        // Set a JSON Array
        JArray array = new JArray();

        // Encode as JSON
        array.Add(new JObject()
        {
            { "ram_usage", data.ToString() }
        });

        // Encode as JSON
        JObject o = new JObject();
        o["data"] = array;

        // Send back data
        var message = o.ToString();
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

    static async Task GetStreamStatus(WebSocketContext socket)
    {
        // Query the SQLite
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        using var con = new SQLiteConnection(cs);
        con.Open();

        string stm = "SELECT value FROM gb_options WHERE parameter = 'stream_status'";

        using var cmd = new SQLiteCommand(stm, con);
        using SQLiteDataReader rdr = cmd.ExecuteReader();

        // Set a JSON Array
        JArray array = new JArray();

        if (rdr.HasRows == true)
        {

            while(rdr.Read())
            {
                if (rdr["value"].ToString() == "0")
                {
                    // Encode as JSON
                    array.Add(new JObject()
                    {
                        { "stream_status", "Offline" }
                    });
                }
                else
                {
                    // Encode as JSON
                    array.Add(new JObject()
                    {
                        { "stream_status", "Online" }
                    });
                }

            }

        }

        // Encode as JSON
        JObject o = new JObject();
        o["data"] = array;

        // Send back data
        var message = o.ToString();
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

    static async Task GetStreamGame(WebSocketContext socket)
    {
        // create twitch api instance
        var api = new TwitchAPI();
        api.Settings.ClientId = Config.TwitchClientId;

        var data = await api.Helix.Channels.GetChannelInformationAsync(Config.TwitchMC_Id, Config.TwitchClientOAuth);

        // Set a JSON Array
        JArray array = new JArray();

        // Encode as JSON
        array.Add(new JObject()
        {
            { "stream_game", data.Data[0].GameName }
        });

        // Encode as JSON
        JObject o = new JObject();
        o["data"] = array;

        var message = o.ToString();

        // Send back data
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

    static async Task GetStreamNotifications(WebSocketContext socket)
    {
        // Query the SQLite
        string cs = @"URI=file:" + AppDomain.CurrentDomain.BaseDirectory + "/Data/bot.db";

        using var con = new SQLiteConnection(cs);
        con.Open();

        string stm = "SELECT * FROM gb_twitch_notifications ORDER BY id DESC LIMIT 6";

        using var cmd = new SQLiteCommand(stm, con);
        using SQLiteDataReader rdr = cmd.ExecuteReader();

        // Set a JSON Array
        JArray array = new JArray();

        if (rdr.HasRows == true)
        {

            while (rdr.Read())
            {

                // Encode as JSON
                array.Add(new JObject()
                {
                    { "type",  rdr["type"].ToString()},
                    { "user",  rdr["user"].ToString()},
                    { "viewers", rdr["viewers"].ToString()},
                });

            }

        }

        // Encode as JSON
        JObject o = new JObject();
        o["data"] = array;

        // Send back data
        var message = o.ToString();
        byte[] bytes = Encoding.ASCII.GetBytes(message);

        WebSocket webSocket = socket.WebSocket;
        await webSocket.SendAsync(bytes, WebSocketMessageType.Text, true, CancellationToken.None);
    }

}