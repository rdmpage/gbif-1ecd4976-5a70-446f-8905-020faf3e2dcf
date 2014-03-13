<?php

// Create Darwin Core Archive for simple occurrence data

error_reporting(E_ALL);

//--------------------------------------------------------------------------------------------------
$dwc_fields = array(
	
	// a
	'associatedReferences'		=> 'http://rs.tdwg.org/dwc/terms/associatedReferences',
	'associatedSequences'		=> 'http://rs.tdwg.org/dwc/terms/associatedSequences',
	
	// b
	'basisOfRecord'				=> 'http://rs.tdwg.org/dwc/terms/basisOfRecord',
	'bibliographicCitation'		=> 'http://purl.org/dc/terms/bibliographicCitation',

	// c
	'catalogNumber' 			=> 'http://rs.tdwg.org/dwc/terms/catalogNumber',
	'collectionCode'			=> 'http://rs.tdwg.org/dwc/terms/collectionCode',
	'continent'					=> 'http://rs.tdwg.org/dwc/terms/continent',
	'county'					=> 'http://rs.tdwg.org/dwc/terms/county',
	'country'					=> 'http://rs.tdwg.org/dwc/terms/country',
	'countryCode'				=> 'http://rs.tdwg.org/dwc/terms/countryCode',
	
	// d
	'datasetID'					=> 'http://rs.tdwg.org/dwc/terms/datasetID',
    'decimalLatitude' 			=> 'http://rs.tdwg.org/dwc/terms/decimalLatitude',
    'decimalLongitude' 			=> 'http://rs.tdwg.org/dwc/terms/decimalLongitude',
	
	
	//i
	'id' 						=> 'http://rs.tdwg.org/dwc/terms/occurrenceID',
	'institutionCode' 			=> 'http://rs.tdwg.org/dwc/terms/institutionCode',
	'island'					=> 'http://rs.tdwg.org/dwc/terms/island',
	'islandGroup'				=> 'http://rs.tdwg.org/dwc/terms/islandGroup',
	
	// l
	'location'					=> 'http://rs.tdwg.org/dwc/terms/locality',
	'locality'					=> 'http://rs.tdwg.org/dwc/terms/locality',
	
	// s
	'scientificName'			=> 'http://rs.tdwg.org/dwc/terms/scientificName',
	'scientificNameAuthorship'	=> 'http://rs.tdwg.org/dwc/terms/scientificNameAuthorship',
	'scientificNameID'			=> 'http://rs.tdwg.org/dwc/terms/scientificNameID',
	'stateProvince'				=> 'http://rs.tdwg.org/dwc/terms/stateProvince',
	
	// t
	'taxonID'					=> 'http://rs.tdwg.org/dwc/terms/taxonID',
	'type'						=> 'http://purl.org/dc/terms/type',
	'typeStatus'				=> 'http://rs.tdwg.org/dwc/terms/typeStatus',
	
	// v
	'verbatimCoordinates' 		=> 'http://rs.tdwg.org/dwc/terms/verbatimCoordinates',
	'verbatimLatitude'			=> 'http://rs.tdwg.org/dwc/terms/verbatimLatitude',
	'verbatimLocality'			=> 'http://rs.tdwg.org/dwc/terms/verbatimLocality',
	'verbatimLongitude'			=> 'http://rs.tdwg.org/dwc/terms/verbatimLongitude',
	
	// w
	'waterBody'					=> 'http://rs.tdwg.org/dwc/terms/waterBody'
);

$delimiter = "\t";

$occurrence_filename 	= 'occurrences.txt';

$file = fopen($occurrence_filename, "r");

// Read first row to get headings
$row = trim(fgets($file));

$occurrence_header = explode("\t", $row);

//print_r($occurrence_header);

// meta
$metadata = new DomDocument('1.0', 'UTF-8');

// Nice output
$metadata->preserveWhiteSpace = false;
$metadata->formatOutput = true;	

$archive = $metadata->appendChild($metadata->createElement('archive'));
$archive->setAttribute('xmlns', 	'http://rs.tdwg.org/dwc/text/');
$archive->setAttribute('xmlns:xsi', 	'http://www.w3.org/2001/XMLSchema-instance');
$archive->setAttribute('xsi:schemaLocation', 'http://rs.tdwg.org/dwc/text/  http://rs.tdwg.org/dwc/text/tdwg_dwc_text.xsd');

// occurrences
$core = $archive->appendChild($metadata->createElement('core'));

$core->setAttribute('encoding', 			'UTF-8');
$core->setAttribute('fieldsTerminatedBy', 	'\t');
$core->setAttribute('linesTerminatedBy', 	'\n');
$core->setAttribute('ignoreHeaderLines',  	'1');
$core->setAttribute('rowType',  			'http://rs.tdwg.org/dwc/terms/Occurrence');

$files = $core->appendChild($metadata->createElement('files'));
$location = $files->appendChild($metadata->createElement('location'));
$location->appendChild($metadata->createTextNode($occurrence_filename));

$id = $core->appendChild($metadata->createElement('id'));
$id->setAttribute('index', 	'0');

$index = 0;
foreach ($occurrence_header as $header)
{
	$field = $core->appendChild($metadata->createElement('field'));
	$field->setAttribute('index', 	$index);
	$field->setAttribute('term', 	$dwc_fields[$header]);
	$index++;
}

echo $metadata->saveXML()

?>