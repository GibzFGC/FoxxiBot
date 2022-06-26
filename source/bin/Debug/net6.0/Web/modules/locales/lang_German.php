<?php
define("_MAINTENANCE", "Wartungsarbeiten");

define("_PAGE_TITLE", "FoxxiBot | Dashboard");
define("_HOME", "Startseite");
define("_NOTIFICATION", "Benachrichtigungen");
define("_NOTIFICATION_ALL", "Alle Benachrichtigungen anzeigen");

define("_BOTNAME", "FoxxiBot");
define("_LOADING", "Laden...");
define("_DASHBOARD", "Dashboard");
define("_MANAGEMENT", "Verwaltung");
define("_BROADCASTER", "LIVESTREAMER");
define("_FOLLOWS", "FOLLOWS");
define("_FOLLOWS_LATEST", "Neueste Follower"); 
define("_VIEWS", "ANSICHTEN");
define("_EVENTS_LATEST", "Neueste Ereignisse");
define("_WAITING_STREAM", "Warten auf den n�chsten Stream!");
define("_GLOBAL_FEAT", "GLOBALE FUNKTIONEN"); 
define("_OTHER_SERVICE", "SONSTIGE DIENSTE");

define("_TWITCH_SETTINGS", "Twitch-Einstellungen");
define("_TWITCH_SETTINGS_MAIN", "Twitch-Bot-Einstellungen");
define("_TWITCH_SETTINGS_PARTNER", "Ich bin ein Affiliate/Partner");
define("_TWITCH_SETTINGS_BOT_CHANNEL", "Bot-Nachricht in Join Channel");
define("_TWITCH_SETTINGS_BOT_CHANNEL_MSG", "Gib deine Bot-Nachricht ein, die verwendet wird, wenn dieser deinem Kanal beitritt");
define("_TWITCH_SETTINGS_STREAM", "Stream-Nachrichten");
define("_TWITCH_SETTINGS_STREAM_FOLLOW", "Twitch-Follow-Nachricht");
define("_TWITCH_SETTINGS_STREAM_FOLLOW_PLACE", "Gib deine Twitch-Follow Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_RAID", "Twitch-Raid-Nachricht");
define("_TWITCH_SETTINGS_STREAM_RAID_PLACE", "Gib deine Twitch-Raid-Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_SUB", "Twitch-Abonnement-Nachricht");
define("_TWITCH_SETTINGS_STREAM_SUB_PLACE", "Gib deine Twitch Abonnenten Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_PRIMESUB", "TwitchPrime-Abonnentennachricht");
define("_TWITCH_SETTINGS_STREAM_PRIMESUB_PLACE", "Gib deine Twitch Prime Subcriber Nachricht ein");
define("_TWITCH_SETTINGS_INFO", "Diese Einstellungen machen den Bot pers�nlicher f�r Ihren Twitch-Kanal.");

define("_TWITCH_FEAT", "TWITCH FUNKTIONEN");
define("_TWITCH_DATA", "Twitch-Daten");
define("_TWITCH_DATA_DELAY", "(Es kann zu einer leichten Verz�gerung kommen...)");

define("_TWITCH_CMDS", "Twitch-Befehle");
define("_TWITCH_ADD_CMD", "Einen Befehl hinzuf�gen");
define("_TWITCH_CMD_INFO", "Befehlsinformationen");
define("_TWITCH_CMD_NAME", "Name (ohne !)");
define("_TWITCH_CMD_NAME_PLACE", "Befehlsname eingeben");
define("_TWITCH_CMD_RESPONSE", "Hier den Antworttext eingeben..."); 
define("_TWITCH_CMD_USEFUL_VARS", "N�tzliche Variablen");
define("_TWITCH_CMD_VARS_INFO", "Hier ist eine Liste der internen Variablen:<br /><br />
{1} - Ein benutzerdefiniertes Argument f�r das, was du m�chtest<br />
{2} - Ein benutzerdefiniertes Argument f�r das, was du m�chtest (funktioniert nur, wenn das erste gesetzt ist)<br />
{dice} - wirft einen W�rfel und liefert einen Zufallswert<br />
{follows} - gibt die Anzahl der Follower auf Ihrem Kanal zur�ck<br />
{game} - gibt das aktuell gespielte Spiel zur�ck<br />
{points} - gibt die aktuellen Punkte des Benutzers zur�ck<br />
{points_name} - gibt den aktuellen Punktnamen im Bot zur�ck<br />
{sender} - gibt den Anzeigenamen des Befehlsbenutzers zur�ck<br />
{title} - gibt den aktuellen Stream-Titel zur�ck<br />
{uptime} - gibt die Live-Stream-Zeit Ihres Kanals zur�ck<br />
{user} - gibt den Zielbenutzer in der Nachricht zur�ck<br />
{views} - gibt die Gesamtansichten Ihres Kanals zur�ck");
define("_TWITCH_CMD_EDIT", "Einen Befehl bearbeiten");
define("_TWITCH_CMD_MNGMNT", "Twitch-Befehlsverwaltung");
define("_TWITCH_CMD_YOURS", "Hier sind Ihre Twitch-Befehle.");

define("_TWITCH_MODERATION", "Twitch-Moderation");
define("_TWITCH_MODERATION_EXPL", "Im Folgenden kannst du festlegen, wie der Bot mit der Twitch-Moderation umgehen soll");
define("_TWITCH_MODERATION_BL", "Schwarze Liste W�rter / URLs");
define("_TWITCH_MODERATOIN_BL_FEAT", "Diese Funktion nimmt die W�rter, die du auf die schwarze Liste gesetzt hast, und entfernt sie aus den Nachrichten.");
define("_TWITCH_MODERATION_WL", "Whitelist-W�rter/URLs");
define("_TWITCH_MODERATOIN_WL_FEAT", "Diese Funktion nimmt die W�rter oder Links, die du in die Whitelist eingetragen hast, und stellt sicher, dass sie gesendet werden.");
define("_TWITCH_MODERATION_FILTER", "Link-Filter");
define("_TWITCH_MODERATION_FILTER_FEAT", "Link-Filterung verhindert, dass Weblinks in deinem Twitch-Chat gepostet werden. (sofern nicht auf der Whitelist)");
define("_TWITCH_MODERATION_CAPS", "Caps Filter");
define("_TWITCH_MODERATION_CAPS_FEAT", "Verhindert, dass Nachrichten gepostet werden, wenn sie �berwiegend aus Gro�buchstaben bestehen.");
define("_TWITCH_MODERATION_SYMBOLS", "Symbols Filter");
define("_TWITCH_MODERATION_SYMBOLS_FEAT", "Verhindert, dass Nachrichten gepostet werden, wenn sie haupts�chlich aus Symbolen bestehen.");
define("_TWITCH_MODERATION_SPAM", "Spam-Filter");
define("_TWITCH_MODERATION_SPAM_FEAT", "Versuch, Nachrichten zu verhindern, die viel Spam enthalten.");
define("_TWITCH_MODERATION_ME", "/me Filter");
define("_TWITCH_MODERATION_ME_FEAT", "Verhindert die Verwendung der /me-Funktion auf Twitch in Chat-Nachrichten.");
define("_TWITCH_MODERATION_PURGE", "Falsche Systemnachrichten l�schen");
define("_TWITCH_MODERATION_PURGE_FEAT", "Damit wird verhindert, dass Leute Nachrichten wie <code>&lt;Nachricht gel�scht&gt;</code> senden.");
define("_TWITCH_MODERATION_SUBMIT", "Achte darauf, deine Einstellungen zu speichern!");

define("_AUDIO", "Audio / Sounds");
define("_AUDIO_ADD", "Hinzuf�gen eines Audio / Sounds"); 
define("_AUDIO_ADD_PAGE", "Hinzuf�gen eines Audio / Sounds"); 
define("_AUDIO_EDIT", "Bearbeiten eines Audio / Sounds");
define("_AUDIO_MANAGEMENT", "Audio / Sound Management");
define("_AUDIO_CLIPS", "Hier sind deine Audio / Sound Clips");
define("_AUDIO_NAME", "Sound Name eingeben");
define("_AUDIO_UPLOAD", "Ton hochladen");
define("_AUDIO_CREATE", "Ton erstellen");
define("_AUDIO_FILE", "Lokale Ton-Datei");
define("_AUDIO_UPDATE", "Ton aktualisieren");
define("_AUDIO_INFO", "Audio-/Toninformationen");
define("_AUDIO_INFO_TEXT", "Du kannst Sounds, Musik oder andere Audiodateien mit dem Bot
hinzuf�gen, wenn du eine Datei hinzuf�gst. Sie kann mit der Funktion \"!sound name\" aufgerufen werden.<br /><br />
Wenn du diese Funktion verwendest, beachte bitte das Urheberrecht und das alle Dateien, die du verwendest entweder dein Eigentum sein m�ssen, du die Erlaubnis hast diese zu verwenden  
oder eine andere Vereinbarung getroffen wurde.<br /><br />
Damit soll verhindert werden, dass du von den Rechteinhabern auf Twitch Copyright Claims oder Schlimmeres erhalten.<br /><br/>
Dieses Modul unterst�tzt die meisten g�ngigen Audioformate �ber das Stream-Browser-Quellen Widget in \"obs/sounds\". Informationen @ <a target=\"_blank\"href=\"https://github.com/goldfire/howler.js#format-recommendations\">Howler</a>");

define("_GIVEAWAY", "Giveaway");
define("_GIVEAWAY_MNGMNT", "Giveaway Verwaltung"); 
define("_GIVEAWAY_INFO", "Hier sind Giveaway-Informationen.");
define("_GIVEAWAY_DETAILS", "Giveaway Details");
define("_GIVEAWAY_NAME", "Giveaway Name");
define("_GIVEAWAY_PLACE_ENTER", "Giveaway Name");
define("_GIVEAWAY_PLACE_INFO", "Bsp. Willst du 100 Punkte gewinnen, dann gib !giveaway ein, um an der Verlosung teilzunehmen");
define("_GIVEAWAY_CLEAR", "Bist du sicher, dass du alle Daten l�schen m�chtest, einschlie�lich der Teilnehmer am Giveaway?");
define("_GIVEAWAY_OPTIONS", "Giveaway-Optionen");
define("_GIVEAWAY_OPTIONS_STAFF", "K�nnen Twitch-Mitarbeiter am Giveaway teilnehmen?"); 
define("_GIVEAWAY_OPTIONS_MODS", "K�nnen Moderatoren am Giveaway teilnehmen?"); 
define("_GIVEAWAY_RESULTS", "Giveaway Ergebnisse"); 
define("_GIVEAWAY_PARTICIPANTS", "Teilnehmer");
define("_GIVEAWAY_NO_WINNER", "Noch kein Giveaway-Gewinner");

define("_NOTIFICATION_MNGMNT", "Benachrichtigungsverwaltung");
define("_NOTIFICATION_LATEST", "Hier sind deine neuesten Twitch-Benachrichtigungen.");

define("_MODERATION", "Moderation");
define("_MODERATION_WL_BL", "Whitelist / Blacklist");
define("_MODERATION_SETTINGS", "Moderationseinstellungen");
define("_MODERATION_MNGMNT", "Whitelist / Blacklist Management");
define("_MODERATION_DEFINITION", "Neue Definition hinzuf�gen");
define("_MODERATION_STRING", "Wort / Textzeichenfolge");
define("_MODERATION_STRING_PLACE", "Gib hier ein Wort oder eine Zeichenfolge ein"); 
define("_MODERATION_LIST", "W�hle eine Liste"); 
define("_MODERATION_ADD", "Hinzuf�gen zu...");
define("_MODERATION_ADD_LIST", "Zur Liste hinzuf�gen");

define("_TICKER", "Ticker");
define("_TICKER_ADD", "Ticker hinzuf�gen");
define("_TICKER_ADDING", "Ticker hinzuf�gen"); 
define("_TICKER_INFO", "Tickerinformationen");
define("_TICKER_NAME", "Name");
define("_TICKER_NAME_PLACE", "Tickername eingeben");
define("_TICKER_RESPONSE", "Antwort");
define("_TICKER_RESPONSE_PLACE", "Hier den Antworttext eingeben..."); 
define("_TICKER_CREATE", "Ticker erstellen");
define("_TICKER_USEFUL", "N�tzliche Informationen");
define("_TICKER_USEFUL_TEXT", "Ticker dienen zur Anzeige von Informationen in einer Consice Box, die mit den von Ihnen festgelegten Informationen scrollt.<br /><br />
Dies k�nnte n�tzlich sein, um Informationen �ber soziale Medien, Veranstaltungen/Treffen/Spielank�ndigungen usw. anzuzeigen.<br /><br />
Du kannst auch festlegen, welche zu jeder Zeit aktiv sind, d.h. sie k�nnen wiederverwendet oder recycelt (bearbeitet) werden."); 
define("_TICKER_EDIT", "Editieren eines Tickers");
define("_TICKER_MNGMNT", "Tickerverwaltung");
define("_TICKER_UPDATE", "Ticker aktualisieren");
define("_TICKER_YOURS", "Hier sind Ihre Ticker.");

define("_TIMERS", "Timer");
define("_TIMERS_ADD", "Einen Timer hinzuf�gen");
define("_TIMERS_ADDING", "Timer hinzuf�gen");
define("_TIMERS_INFO", "Timer-Informationen");
define("_TIMERS_NAME_PLACE", "Timer-Namen eingeben");
define("_TIMERS_RESPONSE_PLACE", "Hier den Antworttext eingeben..."); 
define("_TIMERS_CREATE", "Timer erstellen");
define("_TIMERS_USEFUL", "N�tzliche Informationen");
define("_TIMERS_USEFUL_TEXT", "Timer werden verwendet, um alle 15 Minuten eine
Nachricht anzuzeigen (um Spam zu verhindern). Die Verwendung dieser Timer ist beispielsweise n�tzlich f�r die Anzeige von Social Media.<br /><br />
Wir empfehlen, nicht zu viele Timer zu verwenden, damit deine Zuschauer nicht zu sehr genervt werden.");
define("_TIMERS_EDIT", "Einen Timer bearbeiten");
define("_TIMERS_UPDATE", "Timer aktualisieren");
define("_TIMERS_MNGMNT", "Timer-Verwaltung");
define("_TIMERS_YOURS", "Hier sind Ihre Twitch-Timer.");

define("_DISCORD_SETTINGS", "Discord-Einstellungen");
define("_DISCORD_SETTINGS_MAIN", "Discord-Bot Einstellungen"); 
define("_DISCORD_FEAT", "DISCORD FUNKTIONEN");
define("_DISCORD_CMDS", "Discord-Befehle");
define("_DISCORD_ADD_CMD", "Einen Befehl hinzuf�gen");
define("_DISCORD_CMD_MNGMT", "Discord-Befehlsverwaltung");
define("_DISCORD_UR_CMDS", "Hier sind deine Discord-Befehle.");
define("_DISCORD_BOT_CHANNEL", "Bot-Kanal einstellen");
define("_DISCORD_LOCK_BOT_CHANNEL", "Bot an den Bot-Kanal binden? (Nicht empfohlen, wenn du Plugins verwenden m�chtest!)");
define("_DISCORD_JOIN_CHANNEL", "Begr��ungskanal zum Beitreten/Austreten einstellen"); 
define("_DISCORD_GREET_LEAVE", "Begr��ungs-/Abschiedssystem verwenden?"); 
define("_DISCORD_AUTO_ROLE", "Automatische Rollenvergabe");
define("_DISCORD_SET_AUTO_ROLE", "Automatische Rollenvergabe verwenden?");
define("_DISCORD_STREAM_SETTINGS", "Streaming Einstellungen");
define("_DISCORD_SET_NOTIFY_CHANNEL", "Benachrichtigungskanal einstellen");
define("_DISCORD_NOTIFICATION_SYS", "Verwenden Sie das Stream Benachrichtigungssystem?");
define("_DISCORD_OPTIONAL_SETTINGS", "Optionale Einstellungen f�r Discord, wenn du diese Seite des Bots verwenden m�chten.");
define("_DISCORD_CMD_INFO", "Befehlsinformationen");
define("_DISCORD_CMD_NAME", "Name (ohne Pr�fix)");
define("_DISCORD_CMD_ENTER", "Befehlsname eingeben");
define("_DISCORD_CMD_RESPONSE", "Gib hier den Antworttext ein...");
define("_DISCORD_USEFUL_VARS", "N�tzliche Variablen");
define("_DISCORD_VARS_INFO", "Hier ist eine Liste der internen Variablen:<br/><br />
{1} - Ein benutzerdefiniertes Argument f�r das, was du m�chtest<br />
{2} - Ein benutzerdefiniertes Argument f�r das, was du m�chtest (funktioniert nur, wenn das erste gesetzt ist)<br />
{8ball} - Erzeugt einen 8ball mit Antworten<br />
{dice} - wirft einen W�rfel und liefert einen Zufallswert<br />
{sender} - liefert den Anzeigenamen des Befehlsbenutzers<br />");

define("_PROMO", "Promo / Streamer");
define("_PROMO_MNGMNT", "Discord Promo / Streamer Verwaltung");
define("_PROMO_ADDITION", "Schnelles Hinzuf�gen von Promo / Streamer");
define("_PROMO_STREAMER_NAME", "Twitch-Benutzername des Streamers hinzuf�gen");
define("_PROMO_STREAMER_PLACE", "Gib hier einen Streamernamen ein");
define("_PROMO_STREAMER_ADD_BTN", "Streamer zu Promo hinzuf�gen");
define("_PROMO_STREAMER_REGISTERED", "Hier sind die registrierten Streamer f�r Promo."); 
define("_PROMO_STREAMER_OFFLINE", "Derzeit offline");

define("_TWITTER", "Twitter");
define("_TWITTER_GAME_STATUS", "Einen Spiel-Live-Status hinzuf�gen"); 
define("_TWITTER_STATUS_LIST", "Twitter Statusliste"); 
define("_TWITTER_SETTINGS", "Twitter Einstellungen"); 
define("_TWITTER_LIVE_ADD", "Einen Twitter Live-Status hinzuf�gen"); 
define("_TWITTER_TWEET_INFO", "Tweet-Informationen");
define("_TWITTER_GAME_NAME", "Spielname (muss mit dem Twitch-Namen �bereinstimmen)");
define("_TWITTER_GAME_NAME_PLACE", "Gib einen Spieltitel ein");
define("_TWITTER_CONTENT", "Tweet-Inhalt");
define("_TWITTER_CONTENT_PLACE", "Hier den Tweet-Text eingeben...");
define("_TWITTER_TWEET_CREATE", "Tweet erstellen");
define("_TWITTER_TWEET_UPDATE", "Tweet aktualisieren");
define("_TWITTER_USEFUL_VARS", "N�tzliche Variablen");
define("_TWITTER_VARS_INFO", "Hier ist eine Liste der internen Variablen:<br/><br />
{link} - gibt deine Twitch-Stream-Url zur�ck<br />
{game} - gibt das aktuell zugewiesene Twitch-Spiel zur�ck<br />
{title} - gibt den aktuellen Twitch-Stream-Titel zur�ck<br/><br /> 
Es k�nnten in Zukunft noch weitere hinzugef�gt werden, empfehle uns welche!");
define("_TWITTER_EDIT_STATUS", "Einen Twitter Live Status bearbeiten");
define("_TWITTER_STATUS_MNGMNT", "Twitter Status Management");
define("_TWITTER_STATUS_YOURS", "Hier sind deine Twitter Live Status Benachrichtigungen.");
define("_TWITTER_FEAT", "Twitter Funktionen");
define("_TWITTER_USERNAME", "Twitter Benutzername");
define("_TWITTER_USERNAME_PLACE", "Gib deinen Twitter Benutzernamen ein"); 
define("_TWITTER_ACCESSTOKEN", "Access-Token"); 
define("_TWITTER_ACCESSTOKEN_PLACE", "Gib deinen Access-Token ein");
define("_TWITTER_ACCESSSECRET", "Access-Secret");
define("_TWITTER_ACCESSSECRET_PLACE", "Gib dein API-Secret ein"); 
define("_TWITTER_APIKEY", "Anwendungs-API Schl�ssel"); 
define("_TWITTER_APIKEY_PLACE", "Gib deinen API-Key ein"); 
define("_TWITTER_APISECRET", "Anwendungs-API Secret"); 
define("_TWITTER_APISECRET_PLACE", "Gib dein API-Secret ein"); 
define("_TWITTER_AUTOTWEET", "Live Auto-Tweet");
define("_TWITTER_OPTIONAL", "Dies ist ein optionaler Dienst, wenn du Twitter-Funktionen w�nschst.");

define("_COUNTDOWN", "Countdown Timers");
define("_COUNTDOWN_ADD", "Add a Countdown");
define("_COUNTDOWN_MNGMT", "Countdown Management");
define("_COUNTDOWN_HEADING", "Here are your current countdowns");
define("_COUNTDOWN_ADD_TITLE", "Adding a Countdown");
define("_COUNTDOWN_ADD_INFO", "Countdown Information");
define("_COUNTDOWN_FORM_TITLE", "Countdown Title");
define("_COUNTDOWN_FORM_DATETIME", "Date/Time");
define("_COUNTDOWN_SAVE_CMD", "Save Countdown");
define("_COUNTDOWN_EDIT", "Edit a Countdown");
define("_COUNTDOWN_EDIT_TITLE", "Editing a Countdown");

define("_POINTS", "Punkte");
define("_POINT_RANK", "Punkte-Ranglisten");
define("_POINT_REDEEM", "Punkte-Einl�sungen"); 
define("_POINT_COST", "Punktekosten"); 
define("_POINTS_SETTINGS", "Punkte-Einstellungen");
define("_POINTS_USR_MNGMNT", "Benutzerverwaltung"); 
define("_POINTS_FUN_TOOLS", "Fun Tools");
define("_POINTS_MODIFIER", "Punkte zum �ndern einstellen (funktioniert nur bei Geben an Alle & Nehmen von Allen)"); 
define("_POINTS_RAIN", "Maximale Punkte f�r Make it Rain?");
define("_POINTS_TAKE_ALL", "Von allen nehmen");
define("_POINTS_GIVE_ALL", "Allen geben");
define("_POINTS_MAKE_RAIN", "Lass es regnen!");
define("_POINTS_SETTINGS_MAIN", "Punkte Einstellungen"); 
define("_POINTS_NAME", "Punkte-Name");
define("_POINTS_NAME_ENTER", "Punkte-Name eingeben");
define("_POINTS_SHORT", "Punkte-Kurzname");
define("_POINTS_SHORT_ENTER", "Punkte-Kurzname eingeben"); 
define("_POINTS_GIVEN", "Punkte werden alle 5 Minuten vergeben"); 
define("_POINTS_GIVEN_VALUE", "Punktewert eingeben"); 
define("_POINTS_RANKING", "Punkte-Rangliste");
define("_POINTS_RANKING_TITLE", "Hier sind die aktuellen Punkte-Ranglisten.");
define("_POINTS_REDEEM", "Punkte-Einl�sungen");
define("_POINTS_REDEEM_TITLE", "Hier sind die aktuellen Punkte-Einl�sungen.");
define("_POINTS_REFUNDED", "Erstattet");
define("_POINTS_REFUND", "R�ckerstattung");
define("_POINTS_NOT_PERFORMED", "Nicht durchgef�hrt");
define("_POINTS_SET_COMPLETE", "Als vollst�ndig eingestellt");
define("_POINTS_SET_INCOMPLETE", "Als unvollst�ndig eingestellt");
define("_POINTS_CONFIRM", "Bist du sicher, dass du diesem Nutzer seine Punkte zur�ckerstatten m�chtest?"); 
define("_POINTS_COMPLETED", "Abgeschlossen");

define("_QUOTES", "Zitate");
define("_QUOTES_ADD", "Ein Zitat hinzuf�gen"); 
define("_QUOTES_ADDING", "Ein Zitat hinzuf�gen");
define("_QUOTE_INFORMATION", "Angebotsinformationen");
define("_QUOTE_NAME_PLACE", "Angebotsname eingeben");
define("_QUOTE_TEXT_PLACE", "Hier die Bot-Antwort eingeben...");
define("_QUOTE_SOURCE", "Quelle");
define("_QUOTE_SOURCE_PLACE", "Zitatquelle eingeben"); 
define("_QUOTE_CREATE", "Zitat erstellen"); 
define("_QUOTE_SYSTEM", "Zitat System");
define("_QUOTE_SYSTEM_INFO", "Mit dem Zitatsystem kannst du einige deiner Lieblingszitate aus den Medien (Spiele, Filme usw.) oder sogar Stream-Momente als Zitate speichern, um sie mit anderen zu teilen.<br /><br />
Deine Zuschauer k�nnen \"!quote\" f�r ein zuf�lliges Zitat eingeben oder wenn du einen Namen festgelegt hast, kann das Zitat mit \"!quote name\" aufgerufen werden.<br /><br />
Das funktioniert sowohl auf Discord als auch auf Twitch, also stelle sicher, dass ihr etwas tolles hinzuf�gt!"); 
define("_QUOTE_EDIT", "Editieren eines Zitats");
define("_QUOTE_UPDATE", "Zitat aktualisieren");
define("_QUOTE_MNGMNT", "Zitat Verwaltung");
define("_QUOTE_YOURS", "Hier sind deine Zitate");

define("_BOT_MANAGEMENT", "BOT VERWALTUNG");
define("_SETTINGS", "Einstellungen");
define("_PLUGINS", "Plugins");
define("_BOT_SETTINGS", "Bot-Einstellungen");
define("_BOT_SETTINGS_MAIN", "Bot-Einstellungen");
define("_BOT_SETTINGS_LANG", "Webpanel-Sprache");
define("_BOT_SETTINGS_DEBUG", "Debug-Modus");
define("_BOT_SETTINGS_DEBUG_RESTART", "(erfordert einen Neustart)"); 
define("_BOT_SETTINGS_SIDEBAR", "Seitenmen� Einstellungen"); 
define("_BOT_SETTINGS_DISCORD_MENU", "Discord Men� anzeigen"); 
define("_BOT_SETTINGS_TWITCH_MENU", "Twitch Men� anzeigen"); 
define("_BOT_SETTINGS_TWITTER_MENU", "Twitter Men� anzeigen"); 
define("_BOT_SETTINGS_TOURN_MENU", "Turnier Men� anzeigen");
define("_BOT_SETTINGS_DISCORD_OPT", "Optionale Einstellungen f�r Discord, wenn du planst, diese Seite des Bots zu verwenden.");

define("_HELP", "HILFE & SUPPORT");
define("_VERSION_INFO", "Versionsinformationen");

define("_CHAT_WIDGET_TITLE", "FoxxiBot Chat Widget");

define("_ADD", "Hinzuf�gen");
define("_EDIT", "Bearbeiten");
define("_CLEAR", "L�schen");
define("_TAG", "Tag");
define("_COUNTRY", "Land");
define("_CLEAR_DATA", "Alle Daten l�schen"); 
define("_YES", "Ja");
define("_NO", "Nein");
define("_INFO", "Wichtige Informationen"); 
define("_ACTIVE", "Aktiv");
define("_ID", "ID");
define("_NAME", "Name");
define("_AUTHOR", "Autor");
define("_FILE", "Datei");
define("_TYPE", "Typ");
define("_RECIPIENT", "Empf�nger"); 
define("_STATUS", "Status"); 
define("_ACTION", "Aktion"); 
define("_ACTIONS", "Aktionen"); 
define("_PLAY", "Wiedergabe");
define("_VIEWERS", "Viewer");
define("_VIEWERS_RAID", "Viewer (wenn Raid/Host)"); 
define("_DATE", "Datum");
define("_DATE_TIME", "Datum / Uhrzeit");
define("_UPTIME", "Uptime");
define("_TITLE", "Titel");
define("_RESPONSE", "Antwort");
define("_GAME", "Spiel");
define("_SAVE_SETTINGS", "Einstellungen speichern");
define("_SAVE_DATA", "Daten speichern"); 
define("_PERMISSION", "Berechtigung"); 
define("_CMD", "Befehl"); 
define("_CMDS", "Befehle");
define("_ADD_CMD", "Hinzuf�gen eines Befehls");
define("_CREATE_CMD", "Befehl erstellen");
define("_UPDATE", "Aktualisieren");
define("_UPDATE_CMD", "Befehl aktualisieren");
define("_URL", "URL");
define("_USERID", "Benutzer-ID");
define("_DISPLAYNAME", "Anzeigename");
define("_USERNAME", "Benutzername");
define("_SEARCH_USERNAME", "Benutzername suchen"); 
define("_WHITELIST", "Whitelist");
define("_BLACKLIST", "Blacklist");
define("_ITEM", "Element");
define("_TWEET", "Tweet");
define("_BOT_CONTROLLED", "Botgesteuert");

define("_DELETE_MSG", "Bist du sicher, dass du diesen Eintrag l�schen m�chtest?");
define("_DELETE_MSG_FILES", "Bist du sicher, dass du diesen Eintrag l�schen m�chtest?? \\Wenn ja, l�sche die zugeh�rigen Dateien im Plugins-Ordner, um eine Neuinstallation beim n�chsten Laden zu verhindern!");
define("_DELETE", "L�schen");
define("_DELETE_PLUGIN", "Plugin l�schen");
define("_DELETE_USER_POINTS", "Bist du sicher, dass du diesen Benutzer und seine Punkte l�schen m�chtest?");
