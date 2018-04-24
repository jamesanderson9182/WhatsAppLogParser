PHP Log parser
===============

# To run: 
```php
cd WhatsAppLogParser
php -S localhost:8888
```

# To use
* Open whatsapp
* Open the settings for the chat(s) you want to use
* Press "Export Chat" and send the zip file to yourself. Images are supported
> This works best if you do one chat at a time.
* Unzip the files on your computer
* Move the _chat.txt into the same directory as this project
* Rename the file to something meaningful with no spaces, underscores etc e.g. ```"group.txt"``` or "```"philip.txt"```
* If you exported images, make a directory with the same name as the chat text file without the .txt
* Move the images into this directory


Preview in your browser: http://localhost:8888

# features
* Display each whatsapp log in their own tab
* Show the initials of the sender
* Show the date only once per day 
* Show code in `<code>` tags if they are between backticks 
* Find all files in the current directory that are called `*.txt` i.e. your log files
* Images are displayed