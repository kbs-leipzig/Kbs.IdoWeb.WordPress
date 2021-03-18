var defaultQueryPhaeno = {
	"query": {
		"taxon": {
			"positive": {
				"taxonById": [
					{
						"id": 175,
						"validonly": false
					}
				]
			}
		},
		"place": {
			"positive": {
				"placeById": [
					{
						"id": 8449,
						"cover": 75,
						"center": false
					}
				]
			}
		}
	},
	"spec": {
		"aggregate": [
			{
				"funct": "<math><apply><sum/><ci>x1</ci></apply></math>",
				"params": {
					"x1": 885
				},
				"name": "Sum of count in sample"
			}
		],
		"groups": {
			"row": [
				{
					"def": {
						"classificationType": "informationField",
						"attitudes": {
							"column": 475,
							"value": {
								"type": "phenology", 
								"lowerLimit": [
									{"day": 1, "month": 1}, 
									{"day": 1, "month": 2}, 
									{"day": 1, "month": 3}, 
									{"day": 1, "month": 4}, 
									{"day": 1, "month": 5}, 
									{"day": 1, "month": 6}, 
									{"day": 1, "month": 7}, 
									{"day": 1, "month": 8}, 
									{"day": 1, "month": 9}, 
									{"day": 1, "month": 10}, 
									{"day": 1, "month": 11}, 
									{"day": 1, "month": 12}
								], "upperLimit": [
									{"day": 31, "month": 1}, 
									{"day": 29, "month": 2}, 
									{"day": 31, "month": 3}, 
									{"day": 30, "month": 4}, 
									{"day": 31, "month": 5}, 
									{"day": 30, "month": 6}, 
									{"day": 31, "month": 7}, 
									{"day": 31, "month": 8}, 
									{"day": 30, "month": 9}, 
									{"day": 31, "month": 10}, 
									{"day": 30, "month": 11}, 
									{"day": 31, "month": 12}
								]
							}
						}
					},
					"extra": {}
				}
			],
			"col": [
				{
					"def": {
						"classificationType": "informationField",
						"attitudes": {
							"column": 375,
							"value": {
								"hierarchy": 1
							}
						}
					},
					"extra": {}
				}, {
					"def": {
						"classificationType": "informationField",
						"attitudes": {
							"column": 373,
							"value": {
								"hierarchy": 1
							}
						}
					},
					"extra": {}
				}
			]
		}
	}
};