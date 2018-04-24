<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        img {
            width:150px;
        }
    </style>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <ul class="nav nav-tabs">
        <?php
        date_default_timezone_set('UTC');

        $files = glob("*.txt");
        $logs = [];
        foreach ($files as $file) {
            $logs[str_replace(".txt", "", $file)] = file_get_contents($file);
        }

        foreach ($logs as $name => $log) {
            print '<li><a data-toggle="tab" href="#' . $name . '">' . $name . '</a></li>';
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        $class = " in active";
        foreach ($logs as $name => $log) {
            ?>
            <div id="<?= $name ?>" class="tab-pane fade <?=$class?>">
                <h3><?= $name ?></h3>
                <?php
                // To ensure only one is active
                $class = "";
                $messageLines = explode("\n", $log);

                $previousDate = null;

                foreach ($messageLines as $messageLine) {
                    preg_match("/\[(.*)\] (.*)\:/", $messageLine, $dateAndName);
                    if (sizeof($dateAndName) > 0) {
                        $split = explode($dateAndName[0], $messageLine);
                        $message = $split[1];
                        $split = explode(']', $dateAndName[0]);
                        $date = $split[0];
                        $date = str_replace('[', '', $date);
                        $date = explode(',', $date)[0];

                        $date = DateTime::createFromFormat('d/m/Y', $date);

                        if ($date) {
                            $date->modify('midnight');
                            // Handle text between ``` and put it into code tags
                            $message = preg_replace("/```(.*?)```/", '<code>\1</code>', $message);
                            // Handle text between ` and put it into code tags
                            $message = preg_replace("/`(.*?)`/", '<code>\1</code>', $message);
                            $dateString = $date == $previousDate ? "" : "<h1>" . $date->format('D jS M') . "</h1>";
                            if(strpos($message, "<‎attached>") > 0){
                                $image = trim(explode("<‎attached>", $message)[0]);
                                $imagePath = "/" . $name . "/" . $image;
                                if (file_exists(__DIR__ . str_replace($imagePath, "/", DIRECTORY_SEPARATOR))) {
                                    $message = '<a href="' . $imagePath . '"><img src="' . $imagePath . '"></a>';
                                }
                            }
                            $previousDate = $date;
                            $userName = $split[1];
                            preg_match_all('/[A-Z]+/', $userName, $initials);
                            $initialsString = implode('', $initials[0]);
                            ?>
                            <?= $dateString ?>
                            <p><b><?= $initialsString . "</b> " . $message ?></p>
                            <?php
                        }
                    }
                }
                ?>
            </div>
            <?php
        }

        ?>
    </div>
</body>
</html>