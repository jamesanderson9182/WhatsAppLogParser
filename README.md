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
* Unzip the files on your computer
* Move the _chat.txt into the same directory as this project
* Rename the file to something meaningful with no spaces, underscores etc e.g. ```"group.txt"``` or "```"philip.txt"```
* If you exported images, make a directory with the same name as the chat text file without the .txt
* Move the images into this directory

Sample Directory Layout
```
├── README.md
├── core
│   ├── ...
├── group
│   ├── image-one.jpg
│   └── screenshot.png
├── philip
│   ├── image-one.jpg
│   └── screenshot.png
├── group.txt
├── philip.txt
└── index.php
```

Preview in your browser: http://localhost:8888

# features
* Display each whatsapp log in their own tab
* Show the initials of the sender
* Show the date only once per day 
* Show code in `<code>` tags if they are between backticks 
* Images are displayed
* You can click links

# Purpose
As part of my final year project at university, I had to keep
a journal of my progress of my team project as well as team meeting
minutes. As the good student I am, I wrote my meeting minutes
retrospectively. This helped me work out which dates
certain events occurred. 

WhatsApp is usually fine for searching, but when a day changes to
another can be a little confusing some times

