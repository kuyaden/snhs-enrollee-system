@echo off

REM Get local IP
for /f "tokens=2 delims=:" %%A in ('ipconfig ^| findstr /R /C:"IPv4 Address"') do set IP=%%A
set IP=%IP: =%

REM Run Laravel server in background
start cmd /k "php artisan serve --host=0.0.0.0"

REM Wait a few seconds for server to start
timeout /t 5 >nul

REM Open browser with IP
start http://%IP%:8000
