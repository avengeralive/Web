<?php
/* /app/View/Helper/DocHelper.php */
App::uses('AppHelper', 'View/Helper');

class DocHelper extends AppHelper {
    public function catchAll() {
        set_error_handler([$this, 'exceptions_error_handler']);
    }

    function exceptions_error_handler($severity, $message, $filename, $lineno) {
      if (error_reporting() == 0) {
        return;
      }
      if (error_reporting() & $severity) {
        Configure::write('debug', 1);
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
      }
    }

    public function setHeaders($fileName)
    {
        $array = explode('.', $fileName);
        $extension = end($array);

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="' . rawurlencode($fileName) . '"');
        switch ($extension)
        {
            case 'docx':
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
            break;
            default:
                header('Content-Type: application/octet-stream');
        }
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
    }
}
?>
