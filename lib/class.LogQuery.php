<?php
class LogQuery
{

	private $_data = array('filepath'=>null);
	
    public function GetMatches() {

        $filename = $this->filepath;

        if(!isset($filename) || $filename == ''){
            throw new \LogicException('Filepath missing');
        }
        if (!file_exists($filename)) {
            throw new \LogicException("The file $filename does not exist");
        }

        $parsedLogs = [];
        $logFileHandle = fopen($filename, 'rb');

        while(! feof($logFileHandle)) {

            $currentLine = str_replace(PHP_EOL, '', fgets($logFileHandle));

            if ('[' === $currentLine[0]) {
                if (10000 === \count($parsedLogs)) {
                    return $parsedLogs;
                    $parsedLogs = [];
                }

                $originalline = $currentLine;
                preg_match('~Got error \'(.*)\'~', $originalline, $message);

                $dateArr = [];
                preg_match('~^\[(.*?)\]~', $currentLine, $dateArr);
                $currentLine = str_replace($dateArr[0], '', $currentLine);
                
                $currentLine = trim($currentLine);
                //[Mon Dec 19 12:01:37.628033 2022]
                $errorDateTime = '';
                $format = 'D M d H:i:s.u Y';
                $errorDateTime = DateTime::createFromFormat($format, $dateArr[1]);
                $errorDateTime->setTimezone(new DateTimeZone('Europe/Rome'));
                $errorDateTime = $errorDateTime->format('Y-m-d H:i:s');

                $pattern = "~PHP\ message:.*?on\ line \d+~";
                preg_match_all($pattern, $message[1], $matches);
                
                foreach ($matches[0] as $matche){

                    $originalerror = $matche;
                    // Get the type of the error
                    if (false !== strpos($matche, 'PHP Warning')) {
                        $matche = str_replace('PHP Warning:', '', $matche);
                        $matche = trim($matche);
                        $errorType = 'WARNING';
                    } else if (false !== strpos($matche, 'PHP Notice')) {
                        $matche = str_replace('PHP Notice:', '', $matche);
                        $matche = trim($matche);
                        $errorType = 'NOTICE';
                    } else if (false !== strpos($matche, 'PHP Fatal error')) {
                        $matche = str_replace('PHP Fatal error:', '', $matche);
                        $matche = trim($matche);
                        $errorType = 'FATAL';
                    } else if (false !== strpos($matche, 'PHP Parse error')) {
                        $matche = str_replace('PHP Parse error:', '', $matche);
                        $matche = trim($matche);
                        $errorType = 'SYNTAX';
                    } else if (false !== strpos($matche, 'PHP Exception')) {
                        $matche = str_replace('PHP Exception:', '', $matche);
                        $matche = trim($matche);
                        $errorType = 'EXCEPTION';
                    } else {
                        $errorType = 'UNKNOWN';
                    }

                    if (false !== strpos($matche, ' on line ')) {
                        $errorLine = explode(' on line ', $matche);
                        $errorLine = trim($errorLine[1]);
                        $matche = str_replace(' on line ' . $errorLine, '', $matche);
                    } else {
                        $errorLine = substr($matche, strrpos($matche, ':') + 1);
                        $matche = str_replace(':' . $errorLine, '', $matche);
                    }

                    $errorFile = explode(' in /', $matche);
                    $errorFile = '/' . trim($errorFile[1]);
                    $errorFile = str_replace(CMS_ROOT_PATH, '', $errorFile);
                    $matche = str_replace(' in ' . $errorFile, '', $matche);

                    $errorMessage = str_replace('PHP message:', '', $matche);  
                    $errorMessage = trim($errorMessage);
                    // /[Mon Dec 19 10:37:53.476028 2022] [proxy_fcgi:error] [pid 774] [client 192.168.8.63:64145] AH01071: Got error 'PHP message: PHP Warning:  touch(): Utime failed: Operation not permitted in /mnt/f/local.pearlremodeling.com/public_html/lib/smarty/sysplugins/smarty_template_compiled.php on line 209'

                    //preg_match('~.*(?=\ in\ )~', $errorMessage, $finalmessage);

                    $parsedLogs[] = [
                        'original'  => $originalerror,
                        'dateTime'   => $errorDateTime,
                        'type'       => $errorType,
                        'file'       => substr($errorFile,-80),
                        'line'       => (int)$errorLine,
                        'message'    => $errorMessage,
                        'stackTrace' => []
                    ];

                }

            } // Stack trace beginning line
            else if ('Stack trace:' === $currentLine) {
                $stackTraceLineNumber = 0;

                while (!feof($logFileHandle)) {
                    $currentLine = str_replace(PHP_EOL, '', fgets($logFileHandle));

                    // If the current line is a stack trace line
                    if ('#' === $currentLine[0]) {
                        $parsedLogsLastKey = key($parsedLogs);
                        $currentLine = str_replace('#' . $stackTraceLineNumber, '', $currentLine);
                        $parsedLogs[$parsedLogsLastKey]['stackTrace'][] = trim($currentLine);

                        $stackTraceLineNumber++;
                    } // If the current line is the last stack trace ('thrown in...')
                    else {
                        break;
                    }
                }
            }


        }

      //print_r($parsedLogs);
      return $parsedLogs;
    }

}
?>