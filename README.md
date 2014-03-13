Molecular phylogeny of Banza (Orthoptera: Tettigoniidae), the endemic katydids of the Hawaiian Archipelago
=========================================

GBIF dataset for distribution of Banza katydids, using data from:

Shapiro, L. H., Strazanac, J. S., & Roderick, G. K. (2006, October). Molecular phylogeny of Banza (Orthoptera: Tettigoniidae), the endemic katydids of the Hawaiian Archipelago. Molecular Phylogenetics and Evolution. Elsevier BV. [doi:10.1016/j.ympev.2006.04.006](http://dx.doi.org/10.1016/j.ympev.2006.04.006)

## Step 1

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
