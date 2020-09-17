@echo off
setlocal enabledelayedexpansion

set /p VERSION=<gen_version.txt
set /A VERSION=VERSION+1
(echo !VERSION!)>gen_version.txt

IF %VERSION% LSS 10 SET VERSION=0%VERSION%

SET OUTPUT=block_polyteamgenerator_moodle34_20170303%VERSION%.zip
tar.exe -a -c -f %OUTPUT% polyteamgenerator