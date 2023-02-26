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
define("_TWITCH_SETTINGS_PARTNER", "Ich bin Affiliate/Partner");
define("_TWITCH_SETTINGS_BOT_CHANNEL", "Bot-Nachricht in Join Channel");
define("_TWITCH_SETTINGS_BOT_CHANNEL_MSG", "Gib deine Bot-Nachricht ein, die verwendet werden soll, wenn dieser deinem Kanal beitritt");
define("_TWITCH_SETTINGS_STREAM", "Stream-Nachrichten");
define("_TWITCH_SETTINGS_STREAM_FOLLOW", "Twitch-Follow-Nachricht");
define("_TWITCH_SETTINGS_STREAM_FOLLOW_PLACE", "Gib deine Twitch-Follow-Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_RAID", "Twitch-Raid-Nachricht");
define("_TWITCH_SETTINGS_STREAM_RAID_PLACE", "Gib deine Twitch-Raid-Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_SUB", "Twitch-Abonnement-Nachricht");
define("_TWITCH_SETTINGS_STREAM_SUB_PLACE", "Gib deine Twitch Abonnenten Nachricht ein"); 
define("_TWITCH_SETTINGS_STREAM_PRIMESUB", "Twitch Prime-Abonnentennachricht");
define("_TWITCH_SETTINGS_STREAM_PRIMESUB_PLACE", "Gib deine Twitch Prime Abonnenten Nachricht ein");
define("_TWITCH_SETTINGS_INFO", "Diese Einstellungen machen den Bot pers�nlicher f�r deinen Twitch-Kanal.");

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
{1} - Ein benutzerdefiniertes Argument für alles was du möchtest<br />
{2} - Ein benutzerdefiniertes Argument für alles was du möchtest (funktioniert nur, wenn das erste gesetzt ist)<br />
{dice} - Wirft einen W�rfel und liefert einen Zufallswert<br />
{follows} - Gibt die Anzahl der Follower auf deinem Kanal zur�ck<br />
{game} - Gibt das aktuell gespielte Spiel zur�ck<br />
{points} - Gibt die aktuellen Punkte des Benutzers zur�ck<br />
{points_name} - Gibt den aktuellen Punktnamen im Bot zur�ck<br />
{sender} - Gibt den Anzeigenamen des Befehlsbenutzers zur�ck<br />
{title} - Gibt den aktuellen Stream-Titel zur�ck<br />
{uptime} - Gibt die Live-Stream-Zeit deines Kanals zur�ck<br />
{user} - Gibt den Zielbenutzer in der Nachricht zur�ck<br />
{views} - Gibt die Gesamtansichten deines Kanals zur�ck");
define("_TWITCH_CMD_EDIT", "Einen Befehl bearbeiten");
define("_TWITCH_CMD_MNGMNT", "Twitch-Befehlsverwaltung");
define("_TWITCH_CMD_YOURS", "Hier sind deine Twitch-Befehle.");

define("_TWITCH_CMD_BLACKLIST", "Blacklist");
define("_TWITCH_CMD_BLACKLIST_TITLE", "Commands Blacklist");
define("_TWITCH_CMD_BLACKLIST_ADD", "Add a User to the Blacklist");
define("_TWITCH_CMD_BLACKLIST_ADD_LABEL", "Add a User");
define("_TWITCH_CMD_BLACKLIST_ADD_TEXTBOX", "Add the User you wish to Blacklist here");
define("_TWITCH_CMD_BLACKLIST_ADD_BTN", "Blacklist User");
define("_TWITCH_CMD_BLACKLIST_TABLE_HEADER", "Here are your Blacklisted Users");

define("_TWITCH_MODERATION", "Twitch-Moderation");
define("_TWITCH_MODERATION_EXPL", "Im Folgenden kannst du festlegen, wie der Bot mit der Twitch-Moderation umgehen soll");
define("_TWITCH_MODERATION_BL", "Unerlaubte W�rter / URLs");
define("_TWITCH_MODERATOIN_BL_FEAT", "Diese Funktion nimmt die W�rter oder URLs, die du auf die Blacklist gesetzt hast, und entfernt sie aus den Nachrichten.");
define("_TWITCH_MODERATION_WL", "Whitelist-W�rter / URLs");
define("_TWITCH_MODERATOIN_WL_FEAT", "Diese Funktion nimmt die W�rter oder URLs, die du in die Whitelist eingetragen hast und stellt sicher, dass sie gesendet werden.");
define("_TWITCH_MODERATION_FILTER", "Link-Filter");
define("_TWITCH_MODERATION_FILTER_FEAT", "Link-Filterung verhindert, dass Weblinks in deinem Twitch-Chat gepostet werden. (sofern nicht auf der Whitelist)");
define("_TWITCH_MODERATION_CAPS", "Caps Filter");
define("_TWITCH_MODERATION_CAPS_FEAT", "Verhindert, dass Nachrichten gepostet werden, wenn sie �berwiegend aus Gro�buchstaben bestehen.");
define("_TWITCH_MODERATION_SYMBOLS", "Sonderzeichen Filter");
define("_TWITCH_MODERATION_SYMBOLS_FEAT", "Verhindert, dass Nachrichten gepostet werden, wenn sie haupts�chlich aus Sonderzeichen bestehen.");
define("_TWITCH_MODERATION_SPAM", "Spam-Filter");
define("_TWITCH_MODERATION_SPAM_FEAT", "Es wird versucht Spam Nachrichten zu verhindern.");
define("_TWITCH_MODERATION_ME", "/me Filter");
define("_TWITCH_MODERATION_ME_FEAT", "Verhindert die Verwendung der /me-Funktion auf Twitch in Chatnachrichten.");
define("_TWITCH_MODERATION_PURGE", "Falsche Systemnachrichten l�schen");
define("_TWITCH_MODERATION_PURGE_FEAT", "Damit wird verhindert, dass Leute Nachrichten wie beispielsweise <code>&lt;Nachricht gel�scht&gt;</code> senden.");
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
define("_AUDIO_INFO_TEXT", "Du kannst Sounds, Musik oder andere Audiodateien über diese Oberfläche hinzufügen. Die Funktion kann mit \"!sound name\" aufgerufen werden.<br /><br />
Wenn du diese Funktion verwendest, beachte bitte das Urheberrecht und das alle Dateien, die du verwendest, entweder dein Eigentum sind, du die Erlaubnis hast diese zu verwenden  
oder eine andere Vereinbarung getroffen wurde.<br /><br />
Damit soll verhindert werden, dass du von den Rechteinhabern auf Twitch Copyright Claims oder schlimmeres erhälst.<br /><br/>
Dieses Modul unterst�tzt die meisten g�ngigen Audioformate �ber das Stream-Browser-Quellen Widget in \"obs/sounds\". Informationen @ <a target=\"_blank\"href=\"https://github.com/goldfire/howler.js#format-recommendations\">Howler</a>");

define("_GIVEAWAY", "Giveaway");
define("_GIVEAWAY_MNGMNT", "Giveaway Verwaltung"); 
define("_GIVEAWAY_INFO", "Hier sind Giveaway-Informationen.");
define("_GIVEAWAY_DETAILS", "Giveaway Details");
define("_GIVEAWAY_NAME", "Giveaway Name");
define("_GIVEAWAY_PLACE_ENTER", "Giveaway Name");
define("_GIVEAWAY_PLACE_INFO", "Beispiel: Willst du 100 Punkte gewinnen? Dann gib !giveaway ein, um an der Verlosung teilzunehmen");
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
define("_TICKER_USEFUL_TEXT", "Ticker dienen zur Anzeige von Informationen in einer kompakten Box, die mit den von dir festgelegten Informationen scrollt.<br /><br />
Das k�nnte n�tzlich sein, um Informationen �ber soziale Medien, Veranstaltungen/Treffen/Spielank�ndigungen usw. anzuzeigen.<br /><br />
Du kannst auch festlegen, welche zu jeder Zeit aktiv sind, d.h. sie k�nnen wiederverwendet oder recycelt (bearbeitet) werden."); 
define("_TICKER_EDIT", "Editieren eines Tickers");
define("_TICKER_MNGMNT", "Tickerverwaltung");
define("_TICKER_UPDATE", "Ticker aktualisieren");
define("_TICKER_YOURS", "Hier sind deine Ticker.");

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
Es wird empfohlen nicht zu viele Timer zu verwenden, damit deine Zuschauer nicht zu sehr genervt werden.");
define("_TIMERS_EDIT", "Einen Timer bearbeiten");
define("_TIMERS_UPDATE", "Timer aktualisieren");
define("_TIMERS_MNGMNT", "Timer-Verwaltung");
define("_TIMERS_YOURS", "Hier sind deine Twitch-Timer.");

define("_DISCORD_SETTINGS", "Discord-Einstellungen");
define("_DISCORD_SETTINGS_MAIN", "Discord-Bot Einstellungen"); 
define("_DISCORD_FEAT", "DISCORD FUNKTIONEN");
define("_DISCORD_CMDS", "Discord-Befehle");
define("_DISCORD_ADD_CMD", "Einen Befehl hinzuf�gen");
define("_DISCORD_CMD_MNGMT", "Discord-Befehlsverwaltung");
define("_DISCORD_UR_CMDS", "Hier sind deine Discord-Befehle.");
define("_DISCORD_BOT_CHANNEL", "Bot-Channel");
define("_DISCORD_LOCK_BOT_CHANNEL", "Bot an den Bot-Kanal binden? (Nicht empfohlen, wenn Plugins verwendet werden!)");
define("_DISCORD_JOIN_CHANNEL", "Begr��ungskanal zum Beitreten/Austreten einstellen"); 
define("_DISCORD_GREET_LEAVE", "Begr��ungs-/Abschiedssystem verwenden?"); 
define("_DISCORD_AUTO_ROLE", "Automatische Rollenvergabe");
define("_DISCORD_SET_AUTO_ROLE", "Automatische Rollenvergabe verwenden?");
define("_DISCORD_STREAM_SETTINGS", "Streaming Einstellungen");
define("_DISCORD_SET_NOTIFY_CHANNEL", "Benachrichtigungskanal einstellen");
define("_DISCORD_NOTIFICATION_SYS", "Stream Benachrichtigungssystem verwenden?");
define("_DISCORD_OPTIONAL_SETTINGS", "Optionale Einstellungen f�r Discord, wenn du diese Seite des Bots verwenden m�chtest.");
define("_DISCORD_CMD_INFO", "Befehlsinformationen");
define("_DISCORD_CMD_NAME", "Name (ohne Pr�fix)");
define("_DISCORD_CMD_ENTER", "Befehlsname eingeben");
define("_DISCORD_CMD_RESPONSE", "Gib hier den Antworttext ein...");
define("_DISCORD_USEFUL_VARS", "N�tzliche Variablen");
define("_DISCORD_VARS_INFO", "Hier ist eine Liste der internen Variablen:<br/><br />
{1} - Ein benutzerdefiniertes Argument für alles was du möchtest<br />
{2} - Ein benutzerdefiniertes Argument für alles was du möchtest (funktioniert nur, wenn das erste gesetzt ist)<br />
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

define("_COUNTDOWN", "Countdown Timers");
define("_COUNTDOWN_ADD", "Add a Countdown");
define("_COUNTDOWN_MNGMT", "Countdown Management");
define("_COUNTDOWN_HEADING", "Hier sind deine derzeitigen Countdowns");
define("_COUNTDOWN_ADD_TITLE", "Countdown hinzufügen");
define("_COUNTDOWN_ADD_INFO", "Countdown Informationen");
define("_COUNTDOWN_FORM_TITLE", "Countdown Title");
define("_COUNTDOWN_FORM_DATETIME", "Datum / Uhrzeit");
define("_COUNTDOWN_SAVE_CMD", "Countdown speichern");
define("_COUNTDOWN_EDIT", "Countdown bearbeiten");
define("_COUNTDOWN_EDIT_TITLE", "Einen Countdown bearbeiten");

define("_POINTS", "Punkte");
define("_POINT_RANK", "Punkte Rangliste");
define("_POINT_REDEEM", "Eingelöste Punkte"); 
define("_POINT_COST", "Punkt Kosten"); 
define("_POINTS_SETTINGS", "Punkte-Einstellungen");
define("_POINTS_USR_MNGMNT", "Benutzerverwaltung"); 
define("_POINTS_FUN_TOOLS", "Fun Tools");
define("_POINTS_MODIFIER", "Punkte von allen Zuschauern bearbeiten (Hinzufügen oder nehmen)"); 
define("_POINTS_RAIN", "Maximale Punkte f�r Make it Rain?");
define("_POINTS_TAKE_ALL", "Von allen nehmen");
define("_POINTS_GIVE_ALL", "Allen geben");
define("_POINTS_MAKE_RAIN", "Lass es regnen!");
define("_POINTS_SETTINGS_MAIN", "Punkte Einstellungen"); 
define("_POINTS_NAME", "Punkte-Name");
define("_POINTS_NAME_ENTER", "Punkte-Name eingeben");
define("_POINTS_SHORT", "Punkte-Kürzel");
define("_POINTS_SHORT_ENTER", "Punkte-Kürzel eingeben"); 
define("_POINTS_GIVEN", "Punkte werden alle 5 Minuten vergeben"); 
define("_POINTS_GIVEN_VALUE", "Wie viele Punkte sollen alle 5 Minuten vergeben werden?"); 
define("_POINTS_RANKING", "Punkte-Rangliste");
define("_POINTS_RANKING_TITLE", "Hier ist die aktuelle Rangliste");
define("_POINTS_REDEEM", "Eingelöste Punkte");
define("_POINTS_REDEEM_TITLE", "Hier sind die letzten einlösungen der Punkte");
define("_POINTS_REFUNDED", "Erstattet");
define("_POINTS_REFUND", "R�ckerstattung");
define("_POINTS_NOT_PERFORMED", "Nicht durchgef�hrt");
define("_POINTS_SET_COMPLETE", "Als vollst�ndig eingestellt");
define("_POINTS_SET_INCOMPLETE", "Als unvollst�ndig eingestellt");
define("_POINTS_CONFIRM", "Bist du sicher, dass du diesem Nutzer seine Punkte zur�ckerstatten m�chtest?"); 
define("_POINTS_COMPLETED", "Abgeschlossen");

define("_POINT_BLACKLIST", "Points Blacklist");
define("_POINTS_BLACKLIST_TITLE", "Points Blacklist");
define("_POINTS_BLACKLIST_ADD", "Add a User to the Blacklist");
define("_POINTS_BLACKLIST_ADD_LABEL", "Add a User");
define("_POINTS_BLACKLIST_ADD_TEXTBOX", "Add the User you wish to Blacklist here");
define("_POINTS_BLACKLIST_ADD_BTN", "Blacklist User");
define("_POINTS_BLACKLIST_TABLE_HEADER", "Here are your Blacklisted Users");

define("_QUOTES", "Zitate");
define("_QUOTES_ADD", "Ein Zitat hinzuf�gen"); 
define("_QUOTES_ADDING", "Ein Zitat hinzuf�gen");
define("_QUOTE_INFORMATION", "Zitat Informationen");
define("_QUOTE_NAME_PLACE", "Zitat Namen eingeben");
define("_QUOTE_TEXT_PLACE", "Hier die Bot-Antwort eingeben...");
define("_QUOTE_SOURCE", "Quelle");
define("_QUOTE_SOURCE_PLACE", "Zitatquelle eingeben"); 
define("_QUOTE_CREATE", "Zitat erstellen"); 
define("_QUOTE_SYSTEM", "Zitat System");
define("_QUOTE_SYSTEM_INFO", "Mit dem Zitatsystem kannst du einige deiner Lieblingszitate aus Medien (Spiele, Filme usw.) oder sogar Stream-Momente als Zitate speichern, um sie mit anderen zu teilen.<br /><br />
Deine Zuschauer k�nnen \"!quote\" f�r ein zuf�lliges Zitat eingeben oder wenn du einen Namen festgelegt hast, kann das Zitat mit \"!quote name\" aufgerufen werden.<br /><br />
Diese Befehle funktionieren sowohl auf Discord als auch auf Twitch!"); 
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
define("_BOT_SETTINGS_DEBUG_RESTART", "(Erfordert einen Neustart)"); 
define("_BOT_SETTINGS_SIDEBAR", "Seitenmen� Einstellungen"); 
define("_BOT_SETTINGS_DISCORD_MENU", "Discord Men� anzeigen"); 
define("_BOT_SETTINGS_TWITCH_MENU", "Twitch Men� anzeigen");
define("_BOT_SETTINGS_TOURN_MENU", "Turnier Men  anzeigen");
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
define("_VIEWERS_RAID", "Viewer (Wenn Raid/Host)"); 
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