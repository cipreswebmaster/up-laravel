<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait HelpersTrait {
  /**
   * With the a name slugifyied, look for the corresponding object on the
   * database
   * 
   * @param string $table The BBDD Table
   * @param string $slugifyiedName The name slugifyied
   * @param string $query_condition_field The field title to evaluate the query
   * @param array $exception word (optional) The words less than 2 letters will be included on the query condition
   * 
   * @return Illuminate\Database\Eloquent\Model The response object
   */
  public function getDatabaseInfoWithSlugifyiedName(
    string $table,
    string $slugifyied_name,
    string $query_condition_field,
    array $exception_words = []
  ) {
    $nameExploded = explode("-", $slugifyied_name);
    $wordsToUse = array_values(array_filter($nameExploded, function ($el) use ($exception_words) {
      return strlen($el) > 2 && !in_array($el, $exception_words);
    }));
    $response = DB::table($table)->where($query_condition_field, "LIKE", "%" . $wordsToUse[0] . "%");
    for ($i = 1; $i < count($wordsToUse); $i++) { 
      $response->orWhere($query_condition_field, "LIKE", "%" . $wordsToUse[$i] . "%");
    }
    $res = $response->get();
    $theOne = $this->getTheOne($res, $slugifyied_name, $query_condition_field);
    return $theOne;
  }

  /**
   * Get the area name sluggified
   * 
   * @param string $title The area title
   * @return string The area image name without extension
   */
  private function getAreaImageName(string $title) {
    $withNoCommas = str_replace(",", "", $title);
    $withNoSpaces = str_replace(" ", "-", $withNoCommas);
    return strtolower($withNoSpaces);
  }

  /**
   * Process the data from the excel files and separate it by a specific delimiter
   * 
   * @param string $data The data to be processed
   * @param string $delimiter A flag where to split the data
   * 
   * @return array The processed and curated data
   */
  private function process_data(string $data, string $delimiter = ">>")
  {
    $data_exploded = explode($delimiter, $data);
    for ($i = 0; $i < count($data_exploded); $i++) {
      $data_exploded[$i] = trim(str_replace(["\r", "\n"], "", $data_exploded[$i]));
    }
    return array_values(array_filter($data_exploded));
  }

  public static function getTheOne($response, $name, $fieldName) {
    $nameWithoutSpaces = str_replace("-", "", $name);
    foreach ($response as $res) {
      $resAsArray = json_decode(json_encode($res), true);
      $eliminateFromString = [" ", "-"];
      $responseNameCleaned = str_replace(
        $eliminateFromString, "", strtolower(clean_string($resAsArray[$fieldName]))
      );
      if (trim($nameWithoutSpaces) == $responseNameCleaned)
        return json_decode(json_encode($res), true);
    }
  }
}