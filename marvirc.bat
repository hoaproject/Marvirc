@echo off

BREAK=ON
set PHP="php.exe"
set SCRIPT_DIR=%~dp0
set MARVIRC=%SCRIPT_DIR%Source\Marvirc\Bin\Marvirc.php

"%PHP%" "%MARVIRC%" %*
