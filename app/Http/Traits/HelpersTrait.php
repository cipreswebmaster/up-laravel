<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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
    $especificsWords = [
      "diseno" => "diseño"
    ];
    $nameExploded = explode("-", $slugifyied_name);
    $wordsToUse = array_values(array_filter($nameExploded, function ($el) use ($exception_words) {
      return strlen($el) > 2 && !in_array($el, $exception_words);
    }));
    $condition = isset($especificsWords[$wordsToUse[0]]) ? $especificsWords[$wordsToUse[0]] : $wordsToUse[0];
    $response = DB::table($table)->where($query_condition_field, "LIKE", "%" . $condition . "%");
    for ($i = 1; $i < count($wordsToUse); $i++) { 
      $condition = isset($especificsWords[$wordsToUse[$i]]) ? $especificsWords[$wordsToUse[$i]] : $wordsToUse[$i];
      $response->orWhere($query_condition_field, "LIKE", "%" . $condition . "%");
    }
    $res = $response->get();
    $theOne = $this->getTheOne($res, $slugifyied_name, $query_condition_field);
    return $theOne ? $theOne : abort(404);
  }

  /**
   * Look for the 4Beyond career data with the id
   * 
   * @param int $id The career id
   * 
   * @return array|false The career data
   */
  public function search4BeyondCareerData(int $id, int $area_id, string $token = "0ead8013-43e8-11eb-8ecc-02eef28b5605") {
    if (!$id)
      return false;
    $data = $this->get4BeyondData($area_id, $token);
    $career = "";
    foreach ($data as $d) {
      if ($d["id_carrera"] == $id)
        $career = $d;
    }

    return $career;
  }

  /**
   * Load data from 4Beyond API
   * 
   * @param int $id Area id
   * 
   * @return array The data
   */
  public function get4BeyondData(int $id, $token) {
    if (session_status() == 1)
      session_start();
    if (!isset($_SESSION["4BeyondData"]))
      $_SESSION["4BeyondData"] = [];
    
    if (isset($_SESSION["4BeyondData"][$id]))
      $_SESSION["4BeyondData"][$id];
    else {
      $res = Http::withHeaders([
        "token" => "4bcgp-bgyt",
      ])->post("https://apps4beyond.com/REST/api/consultarCarreras", [
        "token_id" => $token,
        "area_id" => strval($id)
      ]);
      $_SESSION["4BeyondData"][$id] = $res["result"]["resultObject"];
    }

    return $_SESSION["4BeyondData"][$id];
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
      $responseNameCleaned = str_replace(
        "-", "", Str::slug($resAsArray[$fieldName])
      );
      if (trim($nameWithoutSpaces) == $responseNameCleaned)
        return json_decode(json_encode($res), true);
    }
  }
}