using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;

namespace FoxxiBot.Class
{
    internal class Bot_Integrity
    {

        public Bot_Integrity()
        {

            // Check if Data folder exists
            if (!Directory.Exists(AppDomain.CurrentDomain.BaseDirectory + "Data"))
            {
                Directory.CreateDirectory(AppDomain.CurrentDomain.BaseDirectory + "Data");
            }

            // Check if Backup folder exists
            if (!Directory.Exists(AppDomain.CurrentDomain.BaseDirectory + "Data/Backups"))
            {
                Directory.CreateDirectory(AppDomain.CurrentDomain.BaseDirectory + "Data/Backups");
            }

            // Check if Web folder exists
            if (!Directory.Exists(AppDomain.CurrentDomain.BaseDirectory + "Web"))
            {

                Console.WriteLine("The Web Panel folder is missing");
                Console.WriteLine("Please re-download the bot archive and copy the Web folder into the root of the application");
                Console.WriteLine("Closing application in 5 seconds");

                Thread.Sleep(5000);
                System.Environment.Exit(1);
                return;

            }

        }

    }
}
