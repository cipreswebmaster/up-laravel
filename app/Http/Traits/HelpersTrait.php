<?php

namespace App\Http\Traits;

use App\Models\ActualizacionBBDD;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
   * @return array The response object
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

  /**
   * Detect if an URL is a Youtube video
   * 
   * @param string $url
   * 
   * @return bool
   */
  public function URLIsVideo(string $url) : bool {
    return str_contains($url, "www.youtube.com") || str_contains($url, "youtu.be");
  }

  /**
   * Extract YT video code
   * 
   * @param string $url
   * 
   * @return string
   */
  public function getVideoCode(string $url) {
    $url_exploded = explode("/", $url);
    $end = end($url_exploded);
    
    if (str_contains($url, "youtu.be"))
      return $end;

    $variables = $this->extractVideoVariables(explode("?", $end)[1]);
    return $variables["v"];
  }

  /**
   * Detect the result that most closely matches the given reference
   * 
   * @param \Illuminate\Support\Collection $response The database response
   * @param string $name The reference to found the one
   * @param string $fieldName The name of the field to search for the reference
   * 
   * @return array An array with the data
   */
  public static function getTheOne(\Illuminate\Support\Collection $response, string $name, string $fieldName): array {
    $nameWithoutSpaces = str_replace("-", "", $name);
    foreach ($response as $res) {
      $resAsArray = json_decode(json_encode($res), true);
      $responseNameCleaned = str_replace(
        "-", "", Str::slug($resAsArray[$fieldName])
      );
      if (trim($nameWithoutSpaces) == $responseNameCleaned)
        return json_decode(json_encode($res), true);
    }

    return [];
  }

  /**
   * Get the correct path depending on the os the server is running
   * 
   * @param string $path The path given by the program
   * 
   * @return string The correct path to use
   */
  public function getThePath(string $path): string {
    $search = !env("APP_DEBUG") && strpos("/", $path) === false ? "\\" : "/";
    $replace = !env("APP_DEBUG") && strpos("/", $path) === false ? "/" : "\\";
    return str_replace($search, $replace, $path);
  }

  /**
   * 
   * @return void
   */
  public function makeActualizacion(Model $model, string $reference) { 
    $original_values = $model->getOriginal();
    $changed_fields = $model->getChanges();
    
    $keys_changed = array_keys($changed_fields);
    $original_values_changed = [];
    foreach ($keys_changed as $key)
      $original_values_changed[$key] = $original_values[$key];
    
    $log = new ActualizacionBBDD();
    $log->table = $model->getTable();
    $log->previous_state = serialize($original_values_changed);
    $log->new_state = serialize($changed_fields);
    $log->reference = $original_values[$reference];
    $log->save(); 
  }

  /**
   * Take a YouTube URL en convert the URL params into an associative array
   * 
   * @param string $variables The variables from the URL
   * 
   * @return array The associative array
   */
  private function extractVideoVariables(string $variables): array {
    $return = [];
    $variables_exploded = explode("&", $variables);
    foreach ($variables_exploded as $variable) {
      $variable_exploded = explode("=", $variable);
      $return[$variable_exploded[0]] = $variable_exploded[1];
    }

    return $return;
  }
}