<?php

class Dvorane
{

  private $_DvoraneArray = array();

  function __construct()
  {
      $file_array = file("data.csv");

      if(is_array($file_array)) {

        $header_row_array = array();

        foreach ($file_array as $row => $line) {

          $line = trim($line, "\n");
          $line = trim($line, "\r");

          $line_array = explode(";", $line);

          if($row == 0)
            {
                $header_row_array = $line_array;
                unset($this->_DvoraneArray[$row]);
            }
            else
            {
                $this->_DvoraneArray[$row] = array_combine($header_row_array, $line_array);
              }
        }
      }
  }

  function showTermini()
  {

    $file_array = $this->_DvoraneArray;

    array_multisort(array_column($file_array, 'Dvorana'),  SORT_ASC,
                array_column($file_array, 'Datum'), SORT_ASC,
                $file_array);

    $html = '';

    $html .= '
    <table border="1">
        <thead>
            <tr>';

            $row_array = end($file_array);

            if(is_array($row_array))
            {
                foreach($row_array as $key => $val)
                {
                    $html .= '<th>'.$key.'</th>';
                }
            }

            $html .= '
            </tr>
        </thead>
        <tbody>';

            if(is_array($file_array))
            {

                foreach($file_array as $key => $row_array)
                {
                    $html .= '
                    <tr>';

                        if(is_array($row_array))
                        {
                            foreach($row_array as $k => $v)
                            {
                                $html .= '<td>'.$v.'</td>';
                            }
                        }

                    $html .= '
                    </tr>';
                }
            }

        $html .= '
        </tbody>
    </table>';

    return $html;
  }

}



?>
