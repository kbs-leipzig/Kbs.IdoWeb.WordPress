var defaultQueryMap = {
    "query": {
        "place": {
            "positive": {
                "placeById": [{
                    "center": false,
                    "cover": 75,
                    "id": 8449
                }]
            }
        },
        "taxon": {
            "positive": {
                "taxonById": [{
                    "id": 70426,
                    "validonly": false
                }]
            }
        },
        "withDate": {
        	"positive": {
        		"informationField": [{
        			"column": 475,
        			"value": {
        				"exist": true
        			}
        		}]
        	}
        }
    },
    "informationFields": [
        475
    ],
    "spec": {
	 "classificationType": "place",
               "attitudes": {
			"via": "list",
			"cover": 75,
			"center": true,
			"list": 47,
			"level": 1
               }
    }
}

