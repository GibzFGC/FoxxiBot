<?php
// Copyright (C) 2020-2022 FoxxiBot
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

// Check for Secure Connection
if (!defined("G_FW") or !constant("G_FW")) die("Direct access not allowed!");

$gfw["bot_twitch_commands"] = array (
    'addcom',
    'editcom',
    'delcom',
    'permit',
    'raid',
    'disconnect',
    'accountage',
    'deaths',
    'followage',
    'gw',
    'giveaway',
    'so',
    'shoutout',
    'sound',
    'audio',
    'play',
    'duel',
    'gamble',
    'tweet'
);

$gfw["bot_discord_commands"] = array (
    'avatar',
    'anime',
    'cat',
    'cats',
    'catfact',
    'catfacts',
    'dog',
    'dogs',
    'mal',
    'meme',
    'memes',
    'prefix',
    'promo',
    'purge',
    'prune',
    'clear',
    'ping',
    'userinfo',
    'status',
    'system',
    'tv'

);