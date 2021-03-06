<?php
include 'sphinxapi.0.9.9.php';

$client = new SphinxClient();
$client->SetServer("localhost", 3312);

// simple
$file = fopen("spec/fixtures/data/simple.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

// index
$file = fopen("spec/fixtures/data/index.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ", "edition")]);
fclose($file);

// any
$client->SetMatchMode(SPH_MATCH_ANY);

$file = fopen("spec/fixtures/data/any.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test this ")]);
fclose($file);

$client->SetMatchMode(SPH_MATCH_ALL);

// sort
$client->SetSortMode(SPH_SORT_EXTENDED, "id");

$file = fopen("spec/fixtures/data/sort.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("testing ")]);
fclose($file);

$client->SetSortMode(SPH_SORT_RELEVANCE, "");

// boolean
$client->SetMatchMode(SPH_MATCH_BOOLEAN);

$file = fopen("spec/fixtures/data/boolean.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetMatchMode(SPH_MATCH_ALL);

// phrase
$client->SetMatchMode(SPH_MATCH_PHRASE);

$file = fopen("spec/fixtures/data/phrase.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("testing this ")]);
fclose($file);

$client->SetMatchMode(SPH_MATCH_ALL);

// filter
$client->SetFilter("id", array(10, 100, 1000));

$file = fopen("spec/fixtures/data/filter.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->ResetFilters();

// group
$client->SetGroupBy("id", SPH_GROUPBY_ATTR, "id");

$file = fopen("spec/fixtures/data/group.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->ResetGroupBy();

// distinct
$client->SetGroupDistinct("id");

$file = fopen("spec/fixtures/data/distinct.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->ResetGroupBy();

// weights
$client->SetWeights(array(100, 1));

$file = fopen("spec/fixtures/data/weights.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetWeights(array());

// anchor
$client->SetGeoAnchor("latitude", "longitude", 10.0, 95.0);

$file = fopen("spec/fixtures/data/anchor.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->ResetFilters();

// rank_mode
$client->SetRankingMode(SPH_RANK_WORDCOUNT);

$file = fopen("spec/fixtures/data/rank_mode.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetRankingMode(SPH_RANK_PROXIMITY_BM25);

// index_weights
$client->SetIndexWeights(array("people" => 101));

$file = fopen("spec/fixtures/data/index_weights.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetIndexWeights(array());

// index_weights
$client->SetFieldWeights(array("city" => 101));

$file = fopen("spec/fixtures/data/field_weights.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetFieldWeights(array());

// comment
$file = fopen("spec/fixtures/data/comment.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ", "*", "commenting")]);
fclose($file);

// update_simple
$file = fopen("spec/fixtures/data/update_simple.bin", "w");
fwrite($file, $client->UpdateAttributes("people", array("birthday"), array(1 => array(191163600))));
fclose($file);

// keywords_without_hits
$file = fopen("spec/fixtures/data/keywords_without_hits.bin", "w");
fwrite($file, $client->BuildKeywords("pat", "people", false));
fclose($file);

// keywords_with_hits
$file = fopen("spec/fixtures/data/keywords_with_hits.bin", "w");
fwrite($file, $client->BuildKeywords("pat", "people", true));
fclose($file);

// overrides
$client->SetOverride("rating", SPH_ATTR_FLOAT, array(1 => 10.0));

$file = fopen("spec/fixtures/data/overrides.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->ResetOverrides();

// select
$client->SetSelect("selecting");

$file = fopen("spec/fixtures/data/select.bin", "w");
fwrite($file, $client->_reqs[$client->AddQuery("test ")]);
fclose($file);

$client->SetSelect("*");

// filter_array
$client->SetFilter("field", array(1, 2, 3));

$file = fopen("spec/fixtures/data/filter_array.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_array_exclude
$client->SetFilter("field", array(1, 2, 3), true);

$file = fopen("spec/fixtures/data/filter_array_exclude.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_range
$client->SetFilterRange("field", 1, 3);

$file = fopen("spec/fixtures/data/filter_range.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_range_exclude
$client->SetFilterRange("field", 1, 3, true);

$file = fopen("spec/fixtures/data/filter_range_exclude.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_floats
$client->SetFilterFloatRange("field", 5.4, 13.5);

$file = fopen("spec/fixtures/data/filter_floats.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_floats_exclude
$client->SetFilterFloatRange("field", 5.4, 13.5, true);

$file = fopen("spec/fixtures/data/filter_floats_exclude.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();

// filter_boolean
$client->SetFilter("field", array(0, 1));

$file = fopen("spec/fixtures/data/filter_boolean.bin", "w");
fwrite($file, $client->FilterOutput());
fclose($file);

$client->ResetFilters();
?>