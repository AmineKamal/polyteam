@echo off
setlocal enabledelayedexpansion

set /p VERSION=<profile_version.txt
set /A VERSION=VERSION+1
(echo !VERSION!)>profile_version.txt

IF %VERSION% LSS 10 SET VERSION=0%VERSION%

SET OUTPUT=profilefield_polyteam_moodle34_20170303%VERSION%.zip
tar.exe -a -c -f %OUTPUT% polyteamprofile