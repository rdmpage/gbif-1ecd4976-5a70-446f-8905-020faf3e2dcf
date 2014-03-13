Molecular phylogeny of Banza (Orthoptera: Tettigoniidae), the endemic katydids of the Hawaiian Archipelago
=========================================

GBIF dataset for distribution of Banza katydids, using data from:

Shapiro, L. H., Strazanac, J. S., & Roderick, G. K. (2006, October). Molecular phylogeny of Banza (Orthoptera: Tettigoniidae), the endemic katydids of the Hawaiian Archipelago. Molecular Phylogenetics and Evolution. Elsevier BV. [doi:10.1016/j.ympev.2006.04.006](http://dx.doi.org/10.1016/j.ympev.2006.04.006)

## Step 1 Create dataset on GBIF

Create a dataset on GBIF using registry API. The **owningOrganizationKey** is the publisher UUID that you see in the link to the publisher page: http://www.gbif.org/publisher/92f51af1-e917-49bc-a8ed-014ed3a77bec. You also need a secret **installationKey** provided by GBIF, and you also need to authenticate the call using your GBIF portal username and password.

http://api.gbif.org/v0.9/dataset

POST

```javascript
{
	"owningOrganizationKey":"92f51af1-e917-49bc-a8ed-014ed3a77bec",
	"installationKey":"**<your key here>**",
	"title":"Molecular phylogeny of Banza (Orthoptera: Tettigoniidae), the endemic katydids of the Hawaiian Archipelago",
	"type":"OCCURRENCE" 
}
```
RESPONSE

```javascript
"1ecd4976-5a70-446f-8905-020faf3e2dcf"
```

We now have a UUID (1ecd4976-5a70-446f-8905-020faf3e2dcf) for the dataset, which lives here: http://www.gbif.org/dataset/1ecd4976-5a70-446f-8905-020faf3e2dcf

## Step 2 Create and validate Darwin Core archive

Now we need to create the Darwin Core archive. I grabbed the data from Appendix A of [doi:10.1016/j.ympev.2006.04.006](http://dx.doi.org/10.1016/j.ympev.2006.04.006) and pasted it into a Microsoft Excel spreadsheet. I then wrote various simple formulae to transform the data (e.g., convert latitude and longitudes such as 23°03′44′′N 161°55′34′′W into 23.06222222 -161.9261111. The final data set is exported to a tab-delimited text file occurrences.text.

I then generated a meta.xml file, and finally the Darwin Core Archive (DwC-A) (which is simply a zip file):

```
zip dwca.zip meta.xml occurrences.txt
```

Next we need to check that the DwC-A file is valid using the [Darwin Core Archive Validator](http://tools.gbif.org/dwca-validator/).

## Step 3 Create endpoint

Now we need to tell GBIF where to get the data. In this example, the Darwin Core Archive file is hosted by Github (make sure you link to the raw file).

http://api.gbif.org/v0.9/dataset/1ecd4976-5a70-446f-8905-020faf3e2dcf/endpoint

POST
```javascript
{
  "type":"DWC_ARCHIVE",
  "url":"https://github.com/rdmpage/gbif-1ecd4976-5a70-446f-8905-020faf3e2dcf/raw/master/dwca.zip"
}
```

RESPONSE 

HTTP 201 Created

```javascript
39656
```

## Step 4

Wait for GBIF to index the data (helps if you have Tim Robertson on Skype to keep a watchful eye on things). After a few minutes the data starts appearing in GBIF maps and searches.




