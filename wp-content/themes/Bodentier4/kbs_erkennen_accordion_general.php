<?php /* Template Name: kbs_erkennen_general */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/styles/merkmalsbestimmung_general.css" rel="stylesheet" />
</header>
	<style>
		#dkg_panelbar {
			display:none;
		}
	</style>

	<!-- RD Parallax-->
	<?php get_template_part('partials/kbs_parallax_header'); ?>

<div class="entry-content">
    <section class="text-md-left section-80 section-md-110">
        <div class="shell">
			<div class="range">
				<div class="cell-xs-12 cell-md-12 cell-lg-10 col-lg-offset-1 text-left">
					<?php the_content(); ?>
    <!-- START DETERMINATION -->
    <!-- SWITCH BELOW FOR LOCAL DEVELOPMENT PLEASE-->
    <input type=hidden id="topLevelFilter" value="<?php echo get_field('toplevelfilter'); ?>"/>
	<input type="hidden" id="lowLevelFilter" value="<?php echo get_field('lowlevelfilter'); ?>"/>
	<input type="hidden" id="groupFilter" value="<?php echo get_field('groupfilter'); ?>"/>					

	<!-- GLOBAL SCOPE -->
    <script type="text/javascript">
        // adds .naturalWidth() and .naturalHeight() methods to jQuery
        // for retreaving a normalized naturalWidth and naturalHeight.
        (function ($) {
            var
                props = ['Width', 'Height'],
                prop;

            while (prop = props.pop()) {
                (function (natural, prop) {
                    $.fn[natural] = (natural in new Image()) ?
                        function () {
                            return this[0][natural];
                        } :
                        function () {
                            var
                                node = this[0],
                                img,
                                value;

                            if (node.tagName.toLowerCase() === 'img') {
                                img = new Image();
                                img.src = node.src,
                                    value = img[prop];
                            }
                            return value;
                        };
                }('natural' + prop, prop.toLowerCase()));
            }
        }(jQuery));

        const g_crudServiceBaseUrl = "https://idoweb.bodentiere.de/api";
        //const g_crudServiceBaseUrl = "http://corenet.kbs-leipzig.de/api";
        //const g_crudServiceBaseUrl = "http://localhost:56626/api";
        const g_imagePath = "/wp-content/uploads/";
        const g_topLevelFilter = $("input#topLevelFilter").val() || "";
        const g_lowLevelFilter = $("input#lowLevelFilter").val() || "";
        const g_groupFilter = $("input#groupFilter").val() || "regular";
        var g_none_left = false;


        $(document).ready(function () {

            var getItem = function (target) {
                var itemIndex = target[0].value;

                return tabStrip.tabGroup.children("li").eq(itemIndex);
            },
                select = function (e) {
                    if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode)
                        tabStrip.select(getItem($("#tabIndex")));
                },
                append = function (e) {
                    if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode)
                        tabStrip.append({
                            text: $("#appendText").val(),
                            content: "<br>"
                        });
                },
                before = function (e) {
                    if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode)
                        tabStrip.insertBefore({
                            text: $("#beforeText").val(),
                            content: "<br>"
                        }, tabStrip.select());
                },
                after = function (e) {
                    if (e.type != "keypress" || kendo.keys.ENTER == e.keyCode)
                        tabStrip.insertAfter({
                            text: $("#afterText").val(),
                            content: "<br>"
                        }, tabStrip.select());
                };

            $(".toggleTab").click(function (e) {
                var tab = tabStrip.select();

                tabStrip.enable(tab, tab.hasClass("k-state-disabled"));
            });

            $(".selectTab").click(select);
            $("#tabIndex").keypress(select);

            $(".appendItem").click(append);
            $("#appendText").keypress(append);

            $(".beforeItem").click(before);
            $("#beforeText").keypress(before);

            $(".afterItem").click(after);
            $("#afterText").keypress(after);

        /**re-init carousel **/
            var resizeTimer;
            $(window).resize(function () {
                  clearTimeout(resizeTimer);
                  resizeTimer = setTimeout(function() {
                    // Run code here, resizing has "stopped"
                      var $slicks = $('.dk_image_flex_item.image_PIC>.slide_flex_item');
                      $slicks.each(function () {
                        $(this).slick('reinit');
                      });
                  }, 250);
            });

            $(window).on('orientationchange', function() {
                var $slicks = $('.dk_image_flex_item.image_PIC>.slide_flex_item');
                $slicks.each(function () {
                    $(this).slick('reinit');
                })
                $('.dk_image_flex_item.image_PIC>.slide_flex_item').slick('reinit');
            });

        });

        var g_showing_cap = false;

        $(document).on("mouseenter", 'img.lazy_dk_image.image_PIC:not(.k-state-disabled)', function (event) {
            event.stopImmediatePropagation();
            var $figcap = $(this).parent().next("figcaption");
            var text = $figcap.html();
            console.log(text);
            var pic_cap = $(this).closest(".dk_image_flex_item.image_PIC.wrapper").find(".pic_caption_flex_item");
            pic_cap.html(text);
            pic_cap.addClass("visible");
        });

        $(document).on("mouseout", 'img.lazy_dk_image.image_PIC:not(.k-state-disabled)', function (event) {
            var pic_cap = $(this).closest(".dk_image_flex_item.image_PIC.wrapper").find(".pic_caption_flex_item");
            pic_cap.html();
            pic_cap.removeClass("visible");
        });



        /**
         * GLOBALLY USED MODELS & DATASOURCES
         ***/
        /** Query Filters to be used when filtering by Description Keys */
        /** Class and Order Filters -> g_topLevelFilter, g_orderFilter */
        var QueryFilter = kendo.Class.extend({
            KeyName: null,
            DescriptionKeyId: null,
            DescriptionKeyGroupId: null,
            DescriptionKeyGroupName: null,
            DataType: null,
            DataValue: null,
            isDeletable: true,
            isHidden: false,
        });

        /*** NODE!!! **/
        var DescriptionKeyModel = kendo.data.Node.define ({
			id:"DescriptionKeyId",
			fields: {
					DescriptionKeyGroupId: { type: "number", defaultValue: null },
					KeyName: { type: "string", defaultValue: null },
					KeyDescription: { type: "string", defaultValue: null },
					KeyName: { type: "string", defaultValue: null },
					ListSourceJson: { type: "string", defaultValue: null },
					DescriptionKeyType: { type: "string", defaultValue: null },
					TaxonDescription: { type: "string", defaultValue: null },
					BadgeValue: { type: "number", defaultValue: 0 },
			},
			hasChildren: false
		  });
		
		 var DKGModel = kendo.data.Node.define({
            id: "DescriptionKeyGroupId",
            fields: {
                DescriptionKeyGroupId: { type: "number", defaultValue: null },
                KeyGroupName: { type: "string", defaultValue: null },
                DescriptionKeyGroupDataType: { type: "string", defaultValue: null },
                LocalisationJson: { type: "string", defaultValue: null },
                ParentDescriptionKeyGroupId: { type: "number", defaultValue: null },
                //RipValue not in DB - just for sorting
                RipValue: { type: "number", defaultValue: null },
				OrderPriority: { type: "number", defaultValue: 2},
				VisibilityCategoryId: {type: "number", defaultValue: null},
            },
			hasChildren: "DescriptionKey",
			children: {
				schema: {
					data: "DescriptionKey",
					model: DescriptionKeyModel
				}
			}
        });

        var keyGroup_DataSource_full = new kendo.data.HierarchicalDataSource({
            transport: {
                read: {
                    dataType: "json",
                    url: g_crudServiceBaseUrl + "/DescriptionKeyGroups/compound",
                },
            },
            schema: {
                model: DKGModel
            },
			dataBound: function () {
				console.log("dataBound");
			},
            change: function (e) {
                //console.log("keyGroup changed");
            },
            requestEnd: function (e) {
                var that = this;
                var _pic_dk_source_map = this.options.pic_dk_source_map;
                var _pic_dk_keyname_map = this.options.pic_dk_keyname_map;
                //console.log(this.options.pic_dk_source_map);

                if (e.type === "read" && e.response) {
                    var response = e.response;
                    response.forEach(function (it) {
                        //combine all PIC-keys to one
                        //console.log(it);						
						//DKG
						if(it.DescriptionKey) {
								
						}
                        if (it.DescriptionKeyGroupDataType == "PIC") {
                            var listSource_arr = new Array();
                            var dkId_arr = new Array();
                            var dk_arr = it.DescriptionKey;
                            var dkgId = it.DescriptionKeyGroupId;
							dk_arr.forEach(function (i, x) {
                                var dkName = i.KeyName;
                                var j_arr = JSON.parse(i.ListSourceJson);
                                dkId_arr.push(i.DescriptionKeyId);
								if(j_arr) {
									j_arr.forEach(function (ji) {
                                    	listSource_arr.push(ji.trim());
                                    	_pic_dk_keyname_map.set(ji.trim(), dkName);
                                    	if (_pic_dk_source_map.get(ji.trim()) !== 'undefined') {
	                                        _pic_dk_source_map.set(ji.trim(), i.DescriptionKeyId);
    	                                } else {
        	                                if (typeof (_pic_dk_source_map.get(ji) == 'Array')) {
            	                                var existing = _pic_dk_source_map.get(ji);
                	                            existing.push(i.DescriptionKeyId);
                    	                    } else {
                        	                    var existing = new Array();
                            	                existing.push(_pic_dk_source_map.get(ji));
                                	            existing.push(i.DescriptionKeyId);
                                    	    }
                                        	_pic_dk_source_map.set(ji, existing);
                                    	}
                                	});
								}

                                delete dk_arr[x];
                            });
                            it.DescriptionKey = { KeyName: "Bitte aus den Bildern wählen", DescriptionKeyGroupId: dkgId, DescriptionKeyId: dkId_arr.join(','), ListSourceJson: JSON.stringify(Array.from(new Set(listSource_arr))), DescriptionKeyGroupDataType: "PIC" };
                        }
                    });
                }
            },
            pic_dk_source_map: new Map(),
            pic_dk_keyname_map: new Map(),
            sort: [{ field: "OrderPriority", dir: "asc" },{ field: "RipValue", dir: "asc" },{field: "DescriptionKeyId", dir: "desc"}],
            filter: { logic: "and", filters:[{field: "DescriptionKeyGroupDataType", operator: "isnotnull"},{field: "DescriptionKey.BadgeValue", operator: "isnotnull"}]}
        });

        var keyGroup_DataSource_tabs = new kendo.data.DataSource({
            transport: {
                read: {
                    dataType: "json",
                    url: g_crudServiceBaseUrl + "/DescriptionKeyGroups/categories",
                },
            },
            schema: {
                model: DKGModel
            },
        });

        /**
        * GLOBAL FUNCTIONS
        */
        /*** main to start it all */
        /*** TODO: capsule & checks */
        function g_initDetermination() {
            g_initSliders();
			//g_getTaxDescResult();
        }

        function g_showDkgInFilterlist(dkg) {
            viewModel_dkg_pb.showDkg(dkg);
        }

        function g_getSliderValue(dkId, isMax) {
            if (dkId && viewModel_dkg_pb.get("sliderVals")) {
                sliderVals = viewModel_dkg_pb.get("sliderVals");
                if (isMax) {
                    return isNaN(Math.max.apply(null, sliderVals[dkId])) ? Math.ceil(Math.max.apply(null, parseFloat(sliderVals[dkId]))) : Math.ceil(Math.max.apply(null, sliderVals[dkId]));
                }
                return isNaN(Math.min.apply(null, sliderVals[dkId])) ? Math.floor(Math.min.apply(null, parseFloat(sliderVals[dkId]))) : Math.floor(Math.min.apply(null, sliderVals[dkId]));
            }
        }

        function g_setDataAttributes($imgDom) {
            g_setImgCaption($imgDom);
            let width = $imgDom.naturalWidth() || $imgDom.offsetWidth || $imgDom.width();
            let hoight = $imgDom.naturalHeight() || $imgDom.offsetHeight || $imgDom.height();
            $imgDom.closest('a.swipeLink').attr('data-width', width);
            $imgDom.closest('a.swipeLink').attr('data-height', hoight);
        }

	function g_setImgCaption($imgDom, srcString = null) {
		let imgName;	
		if(srcString) {
				imgName = srcString.split(/[/]+/).pop().split(/[.]+/).shift();
			} else {
				imgName = $imgDom.attr('src').split(/[/]+/).pop().split(/[.]+/).shift();
		}

            $.ajax({
                cache: false,
                type: "GET",
                url: g_crudServiceBaseUrl+"/images/byname/" + imgName,
                success: function (data) {
                    g_createFigCaptionDom(data, $imgDom);
                    //console.log(data);
                    return (data);
                },
                error: function (exception) {
                    console.log("Image Caption - Error. Check console");
                    console.log(exception);
                    return null;
                }
            });
    }
	
	function g_createFigCaptionDom(data, $imgDom) {
            if (data !== null) {
                var dataObj = JSON.parse(data);
				//console.log(dataObj);
				if(dataObj.length > 0) {
					//create caption domelement and append
					var caption = document.createElement("figcaption");
					caption.setAttribute('class', 'hidden_caption');
					//var content = document.createTextNode("");
					for (var i in dataObj) {
						var br = document.createElement("br");

						var taxonName = document.createElement("p");
						if(dataObj[i].TaxonName != null) {
							taxonName.innerHTML = "Taxon: " + dataObj[i].TaxonName;
							caption.appendChild(taxonName);
						}

						if(dataObj[i].Author != null) {
							var auth = document.createElement("p");
							auth.innerHTML = "Autor: " + dataObj[i].Author;
							caption.appendChild(auth);
						}

						var copText = "";
						if (dataObj[i].CopyrightText !== null) {
							copText = document.createElement("p");
							copText.innerHTML = "Quelle: " + dataObj[i].CopyrightText;
							caption.appendChild(copText);
						}

						var desc = document.createElement("p");
						desc.innerHTML = "Beschreibung: " + dataObj[i].Description;
						caption.appendChild(desc);

						var lic = "";
						if (dataObj[i].LicenseName !== null) {
							lic = document.createElement("p");
							lic.innerHTML = "Lizenz: " + dataObj[i].LicenseName;
							caption.appendChild(lic);
						}

						//var content = document.createTextNode(taxonName + br + desc + br + auth + br + copText);
					}
					if (typeof (caption) !== 'undefined') {
						$imgDom.closest("figure").append(caption);
					} else {
						console.log("Error creating Figure caption");
					}
				}
            }
        }
		
        function g_getDkgNameByParentId(dkgParentId) {
            var t = setTimeout(function () {
                if (dkgParentId) {
                    if (keyGroup_DataSource_full) {
                        return keyGroup_DataSource_full.get(dkgParentId).get("KeyGroupName");
                    }
                    return "";
                }
            }, 3000);
        }

        function g_preloadImage(img) {
            if (!img.src) {
                const src = img.getAttribute('data-src');
                if (!src) { console.log("lazy failed no src"); return; }
                img.src = src;
            }
        }

        function g_initSliders() {
            $.ajax({
                cache: true,
                type: "GET",
                url: g_crudServiceBaseUrl + "/taxonDescriptions/sliderVals",
                success: function (data) {
                    if (typeof (data) !== 'undefined') {
                        var dataArr = JSON.parse(data);
                        if (typeof (dataArr) !== 'undefined') {
                            viewModel_dkg_pb.set("sliderVals", dataArr);
                        }
                    }
                },
                error: function (exception) {
                    console.log("Slider - Error. Check console");
                    console.log(exception);
                }
            });
        }

        function g_highlightResults() {
            var t = setTimeout(function () {
                $("#taxonResults").addClass('shake');
                var t = setTimeout(function () {
                    $("#taxonResults").removeClass('shake');
                }, 1200);
            }, 1700);
        }

        function g_createOrderFilterQuery(taxonId, taxonName, taxonState) {
            var orderQF = new QueryFilter();
            //sorry for abuse
            orderQF.KeyName = taxonName;
            orderQF.DescriptionKeyId = taxonId;
            orderQF.DescriptionKeyGroupId = "Group";
            orderQF.DescriptionKeyGroupName = "Gruppierung";
            orderQF.DataType = "GROUPING";
            orderQF.DataValue = taxonState;
            orderQF.isHidden = true;
            return orderQF;
        }

        function g_filterByGroup(taxonId, taxonName, taxonStateId) {
            event.stopPropagation();
            if (taxonId !== -1) {
				var selItems = viewModel_dkg_pb.get("selectedItems");
                //every selection in dropdown first deletes the GROUPING filter
                g_removeDataTypeFromSelection("GROUPING");
                for (var f in selItems) {
                    if (selItems.hasOwnProperty(f) && selItems[f].DataType != "TLF") {
                    	delete selItems[f];
                	}
				}
                var orderQF = g_createOrderFilterQuery(taxonId, taxonName, taxonStateId);
                g_removeDataTypeFromSelection("TAXLEVEL");
                viewModel_dkg_pb.selectedItems[orderQF.DescriptionKeyGroupId + ";" + orderQF.DescriptionKeyGroupId] = orderQF;
            } else {
                g_removeDataTypeFromSelection("GROUPING");
            }
            g_updateAll();
        }

        function g_disableInput(exception = false) {
            $(".loading_layer").fadeIn('fast');
            viewModel_Taxons.set("isVisible", false);
            viewModel_dkg_tabs.set("isVisible", false);
            if (!exception) {
                viewModel_queryFilters.set("isVisible", false);
                taxDrop.enable(false);
            }
        }

        function g_enableInput(none_left = false) {
            $(".loading_layer").fadeOut('slow');
            taxDrop.enable(true);
            var t = setTimeout(function () {
                viewModel_Taxons.set("isVisible", true);
            }, 300);
            viewModel_queryFilters.set("isVisible", true);

            if (none_left) {
                viewModel_dkg_tabs.set("isVisible", false);
                viewModel_dkg_pb.set("isVisible", false);
            } else {
                viewModel_dkg_tabs.set("isVisible", true);
                viewModel_dkg_pb.set("isVisible", true);
            }
        }


        function g_removeDataTypeFromSelection(dataType) {
            var selItems = viewModel_dkg_pb.get("selectedItems");
            if (selItems && dataType) {
                for (var f in selItems) {
                    if (selItems.hasOwnProperty(f) && selItems[f].DataType == dataType) {
                        if (selItems[f].isDeletable) {
                            delete selItems[f];
                        }
                    }
                }
            }
        }

	
        //KeyGroupId
        function g_getDataTypeByDKGId(dkgId) {
            if (keyGroup_DataSource_full) {
                return keyGroup_DataSource_full.get(dkgId).get("DescriptionKeyGroupDataType");
            }
            return false;
        }

        //KeyId
        function g_getDataTypeByDKId(dkId) {
            if (keyGroup_DataSource_full) {
                var dkgId = findParents(keyGroup_DataSource_full.data(), dkId);
                if (dkgId.length == 1) {
                    return dkgId[0];
                }
            }
            return false;
        }

        /** HELPER to find DescriptionKey in Hierarchical DataSource **/
        const findParents = (arr, id) => {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i].DescriptionKeyId === id) {
                    return [];
                } else if (arr[i].DescriptionKey && arr[i].DescriptionKey.length) {
                    let t = findParents(arr[i].DescriptionKey, id);

                    if (t !== false) {
                        t.push(arr[i].DescriptionKeyGroupDataType);
                        return t;
                    }
                }
            }
            return false;
        }

        /** HELPER to detect touch devices **/
        function is_touch_device() {  
          try {  
            document.createEvent("TouchEvent");  
            return true;  
          } catch (e) {  
            return false;  
          }  
        }

        function g_getLageRegionByParentDKGId(parentDkgId) {
            if (keyGroup_DataSource_full) {
                if (typeof (keyGroup_DataSource_full.get(parentDkgId)) !== 'undefined') 
				{
					var lageName = g_getKeyGroupNameByDKGId(parentDkgId);
					var regionDkgId = keyGroup_DataSource_full.get(parentDkgId).get("ParentDescriptionKeyGroupId");
					var regionName = g_getKeyGroupNameByDKGId(regionDkgId);
					if(regionName) {
                    	return regionName +" - "+ lageName;
					} else {
						return lageName;
					}
                }
            }
            return false;
        }

		
        function g_getKeyGroupNameByDKGId(dkgId) {
            if (keyGroup_DataSource_full) {
                if (typeof (keyGroup_DataSource_full.get(dkgId)) !== 'undefined') {
                    return keyGroup_DataSource_full.get(dkgId).get("KeyGroupName").replace("; ", "&");
                }
            }
            return false;
        }

        function g_getTaxonNameByTaxonId(taxId) {
            if (viewModel_Taxons.taxons_DataSource) {
                return viewModel_Taxons.taxons_DataSource.get(taxId).get("TaxonName");
            }
            return false;
        }

        function g_getTaxonIdByTaxonName(taxonName) {
            if (viewModel_Taxons.taxons_DataSource.data()) {
                var dataSrc = viewModel_Taxons.taxons_DataSource.data();
                for (let taxItem in dataSrc) {
                    if (dataSrc[taxItem].TaxonName == taxonName) {
                        return dataSrc[taxItem].TaxonId;
                    }
                }
            } else {
                console.log("no taxons_Datasource");
            }
            return null;
        }

        //selectedItemsMap will be set as param when item removed
        function g_updateAll(selectedItemsMap = null) {
            //update request
            if (selectedItemsMap !== null) {
                viewModel_dkg_pb.set("selectedItems", selectedItemsMap);
            }
            //update filter list
            viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"));
            g_updateDropdownSelection();
            //console.log(viewModel_dkg_pb.get("selectedItems"));
            g_getTaxDescResult();
            
        }

        //TODO: make more generic for bodentiere --> GROUPING -> higher-level
        function g_updateDropdownSelection() {
            var selItems = viewModel_dkg_pb.get("selectedItems");
            if (selItems) {
                for (var f in selItems) {
                    if (selItems.hasOwnProperty(f) && selItems[f].DataType == "TAXLEVEL") {
                        //set dropdown to taxlevel found in selectedItems
                        taxDrop.value(selItems[f].KeyName);
                        return;
                    } else if (selItems.hasOwnProperty(f) && selItems[f].DataType == "GROUPING") {
                        nextFlag = false;
                        taxDrop.value(selItems[f].KeyName);
                        return;
                    } else {

                    }
                }
            }
        }

        function g_dkg_UpdateAll(filterDkgId) {
            //update filter list
            if (typeof (filterDkgId) === 'string' && filterDkgId.length > 5) {
                filterDkgId = filterDkgId.split(",");
            }
            viewModel_dkg_pb.set("regionFilter", filterDkgId);
            viewModel_dkg_pb.updateFilter();
        }

        function g_dk_FilterRemovedEvent(filterItemsArray) {
            selectedItemsMap = new Object();
            var isLevelFilterSet = false;

            filterItemsArray.forEach(function (item) {
                if (["TAXLEVEL", "GROUPING", "GGF", "TLF", "LLF"].indexOf(item.DataType) > -1) {
                    isLevelFilterSet = true;
                    selectedItemsMap[item.DescriptionKeyGroupId + ";" + item.DescriptionKeyGroupId] = item;
                } else {
                    selectedItemsMap[item.DescriptionKeyGroupId + ";" + item.DescriptionKeyId] = item;
                }
            });

            //manually add toplevelfilter - one level filter has to be set
            if (!isLevelFilterSet) {
                //g_updateAll fired automatically in trigger.select
            } else {
                console.log("filter removed else");
            }
            g_updateAll();
        }

        function g_getTaxDescResult() {
            var selectedItems = viewModel_dkg_pb.get("selectedItems");
            var queryString = "";
            //for loop string creation
            if (selectedItems != null) {
                for (let item in selectedItems) {
                    //selectedItems.forEach(function (item) {
                    if (selectedItems[item].DataType == "VALUE") {
                        queryString += "&" + "data_value_" + encodeURIComponent(selectedItems[item].DescriptionKeyId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "VALUELIST" || selectedItems[item].DataType == "YESNO" || selectedItems[item].DataType == "OPEN VAL" || selectedItems[item].DataType == "UNKNOWN" || selectedItems[item].DataType == "PIC") {
                        //valuelist, yesno, orderFilter, ...
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
                        //TODO: check if Grouping can be handled same way as VALUELIST, ..
                    } else if (selectedItems[item].DataType == "GROUPING") {
						//TODO: improve
						<?php if(get_field('groupfilter') != "Bodentiere") { ?>
                        	queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
						<?php } ?>
                    } else if (selectedItems[item].DataType == "TAXLEVEL") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
                    } else if (selectedItems[item].DataType == "TLF") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "LLF") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "GGF") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "GENDER") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "POSITION") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue.join(","));
                    }
                };
            }
			
            $.ajax({
                cache: true,
                type: "GET",
                url: g_crudServiceBaseUrl + "/taxonDescriptions?" + queryString,
                beforeSend: function () {
                    g_disableInput();
                },
                success: function (data) {
                    if (typeof (data) !== 'undefined') {
                        var dataArr = JSON.parse(data);
                        if (typeof (dataArr.taxonIdList) != 'undefined') {
                            viewModel_Taxons.applyFilter_taxons(dataArr.taxonIdList);
                            //Notify on last result --> TODO: proper highlighting
                            if (dataArr.taxonIdList.length < 1) {
                                console.log("no taxa left");
                                g_none_left = true;
                            } else {
                                g_none_left = false;
                            }
                        } else {
                            //as of 26.09. we should never get here
                            //viewModel_Taxons.applyFilter_taxons(data);
                            console.log("none left");
                            viewModel_Taxons.applyFilter_taxons(dataArr.taxonIdList);
                        }
                        /***
                         * Item1 = dkList
                         * Item2 = ripOrder
                         **/
                        if (typeof (dataArr.extraPayload) !== 'undefined') {
                            var payloadArr = dataArr.extraPayload;
                            if (payloadArr != null) {
                                /**
                                var dkWhiteListInt = Object.keys(payloadArr.Item1).map(function (x) {
                                  return parseInt(x, 10);
                                });
                                 */
                                viewModel_dkg_pb.set("dkWhitelist", payloadArr.Item1);
                                viewModel_dkg_pb.set("badgesList", payloadArr.Item1);
                                viewModel_dkg_pb.set("ripOrder", payloadArr.Item2);
                                viewModel_dkg_pb.applyFilter_dkg(payloadArr);
                                viewModel_dkg_tabs.set("activeDkgs", payloadArr.Item2);
                                viewModel_dkg_tabs.updateActiveTabs();
                                viewModel_dkg_pb.updateBadges();
                            } else {
                                console.log("PayloadArr NULL -- <= 1 item left?");
                            }
                        }
                    }
                },
                error: function (exception) {
                    console.log("Error:" + exception);
                },
                complete: function () {
                    g_enableInput(g_none_left);
					$("#dkg_panelbar").show();
					var t = setTimeout(function () {
						g_showToast();
					},300);
                }
            });
        }

		function g_showToast() {
			var total = $("#total").html();

			$("#taxon_detail_listview").delay(900).addClass('border');
			if(total > 1) {
				$("#toast").removeClass('alert-success').addClass('alert-info').html("Noch " + total + " Taxa übrig!").delay(900).slideToggle("slow").delay(3600).slideToggle("slow");
			} else {
				$("#toast").removeClass('alert-info').addClass('alert-success').html("Nur noch " + total + " Taxon übrig!").delay(900).slideToggle("slow").delay(3600).slideToggle("slow");
			}
			var t = setTimeout(function () {
				$("#taxon_detail_listview").removeClass('border');
			}, 4500);
		}

	
		var DKModel = kendo.data.Model.define({
            id: "DescriptionKeyId",
            fields: {
                DescriptionKeyId: { type: "number", defaultValue: null },
                DescriptionKeyGroupId: { type: "number", defaultValue: null },
                KeyName: { type: "string", defaultValue: null },
                KeyDescription: { type: "string", defaultValue: null },
                ListSourceJson: { type: "string", defaultValue: null },
                LocalisationJson: { type: "string", defaultValue: null },
                ParentDescriptionKeyId: { type: "number", defaultValue: null },
            }
        });    </script>

    <!-- Level Dropdown -->
	<?php if(get_field('groupfilter') == "Bodentiere") { ?>
		<div class="level_wrap flex_item" style="display:none;">	
	<?php } else { ?>
	    <div class="level_wrap flex_item">
	<?php } ?>
        <h3>Was möchten Sie bestimmen?</h3>
        <div id="taxDropdown" style="width: 100%; min-width: 275px;">
            <div class="dkg-section k-content">
                <input id="taxLevel"
                       data-role="dropdownlist"
                       data-bind="source: dataSource,
                              visible: isVisible" />
            </div>
            <script id="tax_dropdown_template" type="text/x-kendo-template">
                #if(data.TaxonomyStateId != -1) {#
					<span>
					#if(data.TaxonomyStateId == 119) {#
						#:data.TaxonName#
					#} else if(data.TaxonomyStateId == 117) {#
						- #:data.TaxonName#
					#} else if(TaxonomyStateId == 100) {#
						-- #:data.TaxonName#
					#}#
					</span>
                </span>
                #}else{#
					<span>
						#: data.TaxonName#
					</span>
                #}#
            </script>
            <script>

                //TODO: move to viewModel
                function g_onTaxDropSelect(e) {
                    //console.log(e);
                    var t = setTimeout(function () {
                        var dataItem = taxDrop.dataItem();
                        if (dataItem.StateId == null) {
                            e.preventDefault();Ord
                        } else if (dataItem && dataItem.StateId) {
                            var selItems = viewModel_dkg_pb.get("selectedItems");
                            //every selection in dropdown first deletes the GROUPING filter
                            g_removeDataTypeFromSelection("GROUPING");
                            for (var f in selItems) {
                                if (selItems.hasOwnProperty(f) && selItems[f].DataType != "TLF") {
                                    delete selItems[f];
                                }
                            }
                            if (dataItem.StateId !== -1) {
                                //var dataItem = e.dataItem;
                                var taxLevelQF = new QueryFilter();
                                taxLevelQF.KeyName = dataItem.StateListName;
                                taxLevelQF.DescriptionKeyId = dataItem.StateId;
                                taxLevelQF.DescriptionKeyGroupId = "TaxLevel";
                                taxLevelQF.DescriptionKeyGroupName = "Taxonomische Ebene";
                                taxLevelQF.DataType = "TAXLEVEL";
                                taxLevelQF.DataValue = dataItem.StateId;
                                //below optional?
                                viewModel_dkg_pb.set("queryTaxLevel", dataItem.StateId);

                                viewModel_dkg_pb.selectedItems[taxLevelQF.DescriptionKeyGroupId + ";" + taxLevelQF.DescriptionKeyGroupId] = taxLevelQF;
                            } else {
                                //taxlevel filter set to all --> remove from queryList
                                for (var f in selItems) {
                                    if (selItems.hasOwnProperty(f) && selItems[f].DataType == "TAXLEVEL") {
                                        delete selItems[f];
                                    }
                                }
                            }

                            if (this.initBound) {
                                g_updateAll();
                            } else {
                                //need to wait for toplevelfilter
                                //let g_setTopLevelFilter make first call
                                this.initBound = true;
                            }
                        } else {
                            console.log("event :: select no tax level!");
                        }
                    }, 50);

                };

                $("#taxDropdown").kendoDropDownTree({
                    dataTextField: "TaxonName",
                    initBound: false,
                    itemSelectorStr: "#taxDropdown_listbox > li.k-item",
                    //filter: "startswith",
                    //template: kendo.template($("#tax_dropdown_template").html()),
                    dataSource: new kendo.data.HierarchicalDataSource({
                        transport: {
                            read: {
                                dataType: "json",
                                url: g_crudServiceBaseUrl + "/taxonDescriptions/levels/?toplevel=" + encodeURIComponent(g_topLevelFilter) + "&lowLevel=" + encodeURIComponent(g_lowLevelFilter) + "&groupFilter=" + encodeURIComponent(g_groupFilter),
                            }
                        },
						schema: {
                            model: {
                                id: "TaxonId",
                                hasChildren: "hasChildren",
								children: "Children"
                            }
                        },
						sort: { field: "TaxonName", dir: "asc" },
                    }),
					treeview: {
					  select: function(e) {
						var dataItem = e.sender.dataItem(e.node);
						var selItems = viewModel_dkg_pb.get("selectedItems");
                        //every selection in dropdown first deletes the GROUPING filter
                        g_removeDataTypeFromSelection("GROUPING");
                        for (var f in selItems) {
                            if (selItems.hasOwnProperty(f) && selItems[f].DataType != "TLF" && selItems[f].DataType != "LLF" && selItems[f].DataType != "GGF") {
                                delete selItems[f];
                            }
                        }
						var taxonId = dataItem.TaxonId;
                        var taxonName = dataItem.TaxonName;
                        var taxonomyStateId = dataItem.TaxonomyStateId;
                        if (taxonId && taxonName && taxonomyStateId) {
                            g_filterByGroup(taxonId, taxonName, taxonomyStateId);
                        } else {
                            console.log("Error getting filter group data");
                        }
					  }
					},
                    setSearch: function () {
                        this.search("Arten");
                    },
                    select: function (e) {
                        
                    },
                    //below replaced by tax_filterByGroup
                    //select: g_onTaxDropSelect,
                    dataBound: function () {

						if (!this.initBound) {
                            var that = this;
							//console.log(that);
                            var dataSource = this.dataSource;
                            var data = dataSource.data();
                            if (!this._adding) {
                                this._adding = true;
								that.value(dataSource.data()[0]);
								//console.log(dataSource.data()[0]);
								//console.log("###");
								dataSource.data()[0].set("expanded",true);
                                //that.select(0);
                            }
                            this.initBound = true;
                        }
                    }
                });
                var taxDrop = $("#taxDropdown").data("kendoDropDownTree");

				
            </script>
        </div>
    </div>

    <div class="determination_wrapper">
		<!-- LEFT COLUMN -->
        <div class="leftColumn_wrapper">
            <!-- RESULT -->
            <div id="taxonResults" class="viewModel_flex_item flex_item">
                <div class="demo-section k-content wide">
                    <div>
                        <h3>Ergebnis</h3>
						<div id="toast" class="alert alert-success" style="display:none; margin-top: 1rem;"></div>
                        <div id="taxon_detail_listview"
							 data-role="listview"
                             data-template="taxon_detail_template"
                             data-bind="source: taxons_DataSource,
										visible: isVisible,
										events: {
										  change: onChange,
										  dataBound: taxons_DataSourceBound
										}"
                         ></div>
                    </div>
                    <div data-template="taxon_total_template" data-bind="visible: isVisible, source:this" style="margin-top: 1rem;">
                    </div>
                </div>

                <script type="text/x-kendo-tmpl" id="taxon_total_template">
                    #if(total > 0) { #
                    	<p><b>Gesamt: <span id="total" data-bind="text: total"></span></b></p>
                    # } else { #
                    	<p><em>Kein Ergebnis. Bitte 'Gewählte Merkmale' oder 'Taxonomische Ebene' prüfen.</em></p>
                    # } #
                </script>

                <script type="text/x-kendo-tmpl" id="taxon_detail_template">
                    <div class="taxon-view k-widget">
                        <div class="taxon_list_header" data-target="taxon_details_#:TaxonId#" title="Ausklappen">
                            <div class="taxon_name_wrap">
                                <p>
                                    <em>#: TaxonName #</em>
                                    #if(TaxonDescription){#&nbsp;#if(HasBracketDescription){##:TaxonDescription ##}else{##:TaxonDescription##}##}#
                                </p>
                            </div>
                            <!-- TEST TBD-->
                            # if(HasTaxDescChildren) {#
                            <div class="taxon_seeAll_wrap">
	<?php if(get_field('groupfilter') == "Bodentiere") { ?>
	<?php } else { ?>
                                <i class="fas fa-lg fa-key seeAllSpeciesButton" style="color:rgba(167,170,0,1);" aria-hidden="true" onClick="g_filterByGroup(#:TaxonId#, '#=TaxonName#', #=TaxonomyStateId#)" id="seeAll_#:TaxonId#" data-taxonid="#:TaxonId#" data-target="#:TaxonName# bstimmen" title="#:TaxonName# bestimmen"></i>
	<?php } ?>
                            </div>
                            # }#
                            <!-- Level Order -->
                            # if(TaxonomyStateId !== 301) { #
                            # } #
                        </div>
                        <div class="taxon_details" id="taxon_details_#:TaxonId#">
                            # if(TaxonDescription !== null || TaxonDistribution !== null || TaxonBiotopeAndLifestyle !== null) { #
                            <ul>
                                # if(TaxonDescription !== null) { #
                                <li>#: TaxonDescription #</li>
                                #}#
                                # if(TaxonDistribution !== null) { #
                                <li>#: TaxonDistribution #</li>
                                #}#
                                # if(TaxonBiotopeAndLifestyle !== null) { #
                                <li>#: TaxonBiotopeAndLifestyle #</li>
                                #}#
                            </ul>
                            #}#
                            <ul>
                                # if(KingdomId) { #
                                <li><strong>Kingdom: </strong>#: g_getTaxonNameByTaxonId(KingdomId) #</li>
                                # } #
                                # if(PhylumId) { #
                                <li><strong>Phylum: </strong>#: g_getTaxonNameByTaxonId(PhylumId) #</li>
                                # } #
                                # if(SubphylumId) { #
                                <li><strong>SubPhylum: </strong>#: g_getTaxonNameByTaxonId(SubphylumId) #</li>
                                # } #
                                # if(ClassId) { #
                                <li><strong>Class: </strong>#: g_getTaxonNameByTaxonId(ClassId) #</li>
                                # } #
                                # if(SubclassId) { #
                                <li><strong>Subclass: </strong>#: g_getTaxonNameByTaxonId(SubclassId) #</li>
                                # } #
                                # if(OrderId) { #
                                <li><strong>Order: </strong>#: g_getTaxonNameByTaxonId(OrderId) #</li>
                                # } #
                                # if(SuborderId) { #
                                <li><strong>Suborder: </strong>#: g_getTaxonNameByTaxonId(SuborderId) #</li>
                                # } #
                                # if(FamilyId) { #
                                <li><strong>Family: </strong>#: g_getTaxonNameByTaxonId(FamilyId) #</li>
                                # } #
                                # if(SubfamilyId) { #
                                <li><strong>Subfamily: </strong>#: g_getTaxonNameByTaxonId(SubfamilyId) #</li>
                                # } #
                            </ul>
                            <div>
                                <button class="btn btn-green" onclick="g_openTaxonDetails('#:TaxonName#')" data-target="#:TaxonId#">
                                    <span class="taxonDetails_long">zum Steckbrief #:TaxonName#</span>
                                    <span class="taxonDetails_short" style="color:white;">Zum Steckbrief&nbsp;<i class="fa fa-bug fa-lg" aria-hidden="true" title="Steckbrief #:TaxonName#"></i></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </script>


                <script>
                    /**
                     * 
                     * @param taxName
                     * only works with wordpress function to scan pages
                     */
                    function g_openTaxonDetails(taxName) {
						if(taxName) {
							$.ajax({
								cache: true,
								type: 'POST',
								url: "/wp-admin/admin-ajax.php",
								data: {
									'action': 'search_page_by_title',
									'data': taxName
								},
								success: function(response) {
									//console.log(response);
									response = response.replace(/[^A-Za-z0-9:/.?=&_]/g, '');
									//console.log(response);
									if(response.match(/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/g)) {
										console.log("match");
										window.open(response, "_blank");
									} else {
										console.log("no match");
										//open default steckbrief page with dynamic content
										//window.open("/steckbrief/?tax=" + encodeURIComponent(taxName), "_blank");
								   	}
								},
								error: function (request, status, error) {
							        alert(request.responseText);
									alert(error);
    							},
								complete: function () {
									console.log("done. complete.");
								}
							});
						}
                    }

                    var TaxonModel = kendo.data.Model.define({
                        id: "TaxonId",
                        fields: {
                            TaxonId: { type: "number", defaultValue: null },
                            KingdomId: { type: "number", defaultValue: null },
                            PhylumId: { type: "number", defaultValue: null },
                            ClassId: { type: "number", defaultValue: null },
                            OrderId: { type: "number", defaultValue: null },
                            FamilyId: { type: "number", defaultValue: null },
                            SubfamilyId: { type: "number", defaultValue: null },
                            GenusId: { type: "number", defaultValue: null },
                            SpeciesId: { type: "number", defaultValue: null },
                            TaxonName: { type: "string" },
                            LocalisationJson: { type: "string" },
                            TaxonDescription: { type: "string" },
                            TaxonomyStateId: { type: "number", defaultValue: null },
                            Diagnose: { type: "string" },
                            IdentificationLevelMale: { type: "string" },
                            IdentificationLevelFemale: { type: "string" },
                            TaxonDistribution: { type: "string" },
                            TaxonBiotopeAndLifestyle: { type: "string" },
                            DescriptionBy: { type: "string" },
                            DescriptionYear: { type: "number", defaultValue: null }
                        }
                    });

                    var viewModel_Taxons = kendo.observable({
                        isVisible: false,
                        initBound: false,
                        taxons_DataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    url: g_crudServiceBaseUrl + "/taxons",
                                    type: "get",
                                    dataType: "json"
                                },
                            },
                            filter: {
                                filters: [
                                    { field: "GenusId", operator: "isnotnull" }
                                ]
                            },
                            schema: {
                                model: TaxonModel
                            },
                        }),
                        taxons_DataSourceBound: function (e) {
                            if (!this.initBound) {
                                g_setUpInitialLevelFilter();
                                //console.log("g_setUpInitialLevelFilter");
                                this.initBound = true;
                            }
                            this.set("total", this.get("taxons_DataSource").total());
                        },
                        total: null,
                        taxonIdFilter: null,
                        applyFilter_taxons: function (taxonIds) {
                            var _fltMain = [];
                            var _flt = { logic: "or", filters: [] };
                            if (taxonIds.length > 0) {
                                for (var key in taxonIds) {
                                    _flt.filters.push({ field: "TaxonId", operator: "eq", value: taxonIds[key] });
                                }
                            } else {
                                _flt.filters.push({ field: "TaxonId", operator: "eq", value: -1 });
                            }
                            _fltMain.push(_flt);
                            this.taxons_DataSource.query({ filter: _fltMain });
                            this.set("total", this.get("taxons_DataSource").total());
                            if (this.get("total") == 1) {
								console.log("highlighting results: " + this.get("total"));
                                g_highlightResults();
                            }
                        }
                    });

                    kendo.bind($("#taxonResults"), viewModel_Taxons);

                    $("#taxonResults").on("click", ".taxon-view > .taxon_list_header", function (e) {
                        var target = $(this).data('target');
                        $("#" + target).slideToggle();
                    });

                </script>
            </div>


            <script>
                
                /** PhotoSwipe Extra **/
                var initPhotoSwipeFromDOM = function (gallerySelector) {
                    // parse slide data (url, title, size ...) from DOM elements
                    // (children of gallerySelector)
                    var parseThumbnailElements = function (el) {
                        var thumbElements = el.childNodes,
                            numNodes = thumbElements.length,
                            items = [],
                            figureEl,
                            linkEl,
                            size,
                            item;

                        for (var i = 0; i < numNodes; i++) {

                            figureEl = thumbElements[i];

                            // include only element nodes
                            if (figureEl.nodeType !== 1) {
                                continue;
                            }

                            linkEl = figureEl.children[0]; // <a> element

                            //size = linkEl.getAttribute('data-size').split('x');

                            // create slide object
                            item = {
                                src: linkEl.getAttribute('href'),
                                w: parseInt(linkEl.getAttribute('data-width'), 10),
                                h: parseInt(linkEl.getAttribute('data-height'), 10)
                            };

                            if (figureEl.children.length > 1) {
                                // <figcaption> content
                                item.title = figureEl.children[1].innerHTML;
                            }

                            if (linkEl.children.length > 0) {
                                // <img> thumbnail element, retrieving thumbnail url
                                item.msrc = linkEl.children[0].getAttribute('src');
                            }

                            item.el = figureEl; // save link to element for getThumbBoundsFn
                            items.push(item);
                        }

                        return items;
                    };

                    // find nearest parent element
                    var closest = function closest(el, fn) {
                        return el && (fn(el) ? el : closest(el.parentNode, fn));
                    };

                    // triggers when user clicks on thumbnail
                    var onThumbnailsClick = function (e) {
                        e = e || window.event;
                        e.preventDefault ? e.preventDefault() : e.returnValue = false;

                        var eTarget = e.target || e.srcElement;

                        // find root element of slide
                        var clickedListItem = closest(eTarget, function (el) {
                            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
                        });

                        if (!clickedListItem) {
                            return;
                        }

                        // find index of clicked item by looping through all child nodes
                        // alternatively, you may define index via data- attribute
                        var clickedGallery = clickedListItem.parentNode,
                            childNodes = clickedListItem.parentNode.childNodes,
                            numChildNodes = childNodes.length,
                            nodeIndex = 0,
                            index;

                        for (var i = 0; i < numChildNodes; i++) {
                            if (childNodes[i].nodeType !== 1) {
                                continue;
                            }

                            if (childNodes[i] === clickedListItem) {
                                index = nodeIndex;
                                break;
                            }
                            nodeIndex++;
                        }


                        if (index >= 0) {
                            // open PhotoSwipe if valid index found
                            openPhotoSwipe(index, clickedGallery);
                        }
                        return false;
                    };

                    // parse picture index and gallery index from URL (#&pid=1&gid=2)
                    var photoswipeParseHash = function () {
                        var hash = window.location.hash.substring(1),
                            params = {};

                        if (hash.length < 5) {
                            return params;
                        }

                        var vars = hash.split('&');
                        for (var i = 0; i < vars.length; i++) {
                            if (!vars[i]) {
                                continue;
                            }
                            var pair = vars[i].split('=');
                            if (pair.length < 2) {
                                continue;
                            }
                            params[pair[0]] = pair[1];
                        }

                        if (params.gid) {
                            params.gid = parseInt(params.gid, 10);
                        }

                        return params;
                    };

                    var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
                        var pswpElement = document.querySelectorAll('.pswp')[0],
                            gallery,
                            options,
                            items;

                        items = parseThumbnailElements(galleryElement);

                        // define options (if needed)
                        options = {

                            // define gallery index (for URL)
                            galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                            getThumbBoundsFn: function (index) {
                                // See Options -> getThumbBoundsFn section of documentation for more info
                                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                                    rect = thumbnail.getBoundingClientRect();

                                return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
                            }

                        };

                        // PhotoSwipe opened from URL
                        if (fromURL) {
                            if (options.galleryPIDs) {
                                // parse real index when custom PIDs are used
                                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                                for (var j = 0; j < items.length; j++) {
                                    if (items[j].pid == index) {
                                        options.index = j;
                                        break;
                                    }
                                }
                            } else {
                                // in URL indexes start from 1
                                options.index = parseInt(index, 10) - 1;
                            }
                        } else {
                            options.index = parseInt(index, 10);
                        }

                        // exit if index not found
                        if (isNaN(options.index)) {
                            return;
                        }

                        if (disableAnimation) {
                            options.showAnimationDuration = 0;
                        }

                        // Pass data to PhotoSwipe and initialize it
                        gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                        gallery.init();
                    };

                    // loop through all gallery elements and bind events
                    var galleryElements = document.querySelectorAll(gallerySelector);

                    for (var i = 0, l = galleryElements.length; i < l; i++) {
                        galleryElements[i].setAttribute('data-pswp-uid', i + 1);
                        galleryElements[i].onclick = onThumbnailsClick;
                    }

                    // Parse URL and open gallery if it contains #&pid=3&gid=1
                    var hashData = photoswipeParseHash();
                    if (hashData.pid && hashData.gid) {
                        openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
                    }
                };
            </script>
            <script>
                function g_setUpInitialLevelFilter() {
                    if (taxDrop) {
						/**
                        var index = taxDrop.selectedIndex;
						console.log(index);
						console.log(taxDrop.value());
                        if (taxDrop.options.optionLabel && index > 0) {
                            index = index - 1;
                        }
						**/
                        var dataItem = taxDrop.value();
						console.log(dataItem);
                        var orderQF = g_createOrderFilterQuery(dataItem.TaxonId, dataItem.TaxonName, dataItem.TaxonomyStateId);
                        viewModel_dkg_pb.selectedItems[orderQF.DescriptionKeyGroupId + ";" + orderQF.DescriptionKeyGroupId] = orderQF;
                        viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"))
                    }

                    if (g_topLevelFilter != "") {
                        var classQF = new QueryFilter();
                        classQF.KeyName = g_topLevelFilter;
                        classQF.DescriptionKeyGroupId = "TLF";
                        classQF.DescriptionKeyGroupName = "TopLevelFilter";
                        classQF.DataType = "TLF";
                        classQF.DataValue = g_getTaxonIdByTaxonName(g_topLevelFilter);
                        classQF.isDeletable = false;
                        classQF.isHidden = true;
                        viewModel_dkg_pb.selectedItems[classQF.DescriptionKeyGroupId + ";" + classQF.DescriptionKeyGroupId] = classQF;
                        viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"));
                    }
                    if (g_lowLevelFilter != "") {
                        var classQF = new QueryFilter();
                        classQF.KeyName = g_lowLevelFilter;
                        classQF.DescriptionKeyGroupId = "LLF";
                        classQF.DescriptionKeyGroupName = "LowLevelFilter";
                        classQF.DataType = "LLF";
                        classQF.DataValue = g_lowLevelFilter;
                        classQF.isDeletable = false;
                        classQF.isHidden = true;
                        viewModel_dkg_pb.selectedItems[classQF.DescriptionKeyGroupId + ";" + classQF.DescriptionKeyGroupId] = classQF;
                        viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"));
                    }

                    var classQF = new QueryFilter();
                    classQF.KeyName = g_groupFilter;
                    classQF.DescriptionKeyGroupId = "GGF";
                    classQF.DescriptionKeyGroupName = "GlobalGroupFilter";
                    classQF.DataType = "GGF";
                    classQF.DataValue = g_groupFilter || "regular";
                    classQF.isDeletable = false;
                    classQF.isHidden = true;
                    viewModel_dkg_pb.selectedItems[classQF.DescriptionKeyGroupId + ";" + classQF.DescriptionKeyGroupId] = classQF;
                    viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"));
                    g_updateAll();
                }

                function initCarousel(e) {
                    console.log(e);
                    var $ctx = $(e);
                    console.log($ctx);
                    var t = setTimeout(function () {
                        var $flex_item = $ctx.closest(".k-item").find('.dk_image_flex_item.image_PIC>.slide_flex_item');
                        console.log($flex_item);
                        if (!$flex_item.hasClass('slick-initialized')) {
                            var picCarousel = $flex_item.slick({
                                mobileFirst: true,
                                infinite: false,
                                slidesToShow: 5,
                                slidesToScroll: 1,
                                slide: '.item',
                                responsive: [
                                    {
                                        breakpoint: 1400,
                                        settings: {
                                            slidesToShow: 4,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 1200,
                                        settings: {
                                            slidesToShow: 4,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 1024,
                                        settings: {
                                            slidesToShow: 4,
                                            slidesToScroll: 1,
                                        }
                                    },
									{
                                        breakpoint: 900,
                                        settings: {
                                            slidesToShow: 3,
                                            slidesToScroll: 1,
                                        }
                                    },
                                    {
                                        breakpoint: 600,
                                        settings: {
                                            slidesToShow: 2,
                                            slidesToScroll: 1
                                        }
                                    },
                                    {
                                        breakpoint: 480,
                                        settings: {
                                            slidesToShow: 1,
                                            slidesToScroll: 1
                                        }
                                    }
                                    // You can unslick at a given breakpoint now by adding:
                                    // settings: "unslick"
                                    // instead of a settings object
                                ]
                            });
                            console.log("carousel initialized");
                            console.log(picCarousel);
                        }
                    }, 300);

                }
            </script>
        </div>


		<!-- RIGHT COLUMN -->
        <div class="rightColumn_wrapper">
			<div class="pre_descriptionkeys_wrapper">
			<div class="merkmal_wrapper flex_item">
			<!-- FILTER LIST -->
            <h3>Gewählte Merkmale</h3>
            <div id="dkFilterListView" class="viewModel_flex_item flex_item">
                <div data-bind="source: queryFilters_DataSource, visible: isVisible" data-template="filter-detail-template">
                </div>
            </div>
            <script type="text/x-kendo-tmpl" id="filter-detail-template">
                # if(typeof(isHidden) !== 'undefined') { #
                # if(!isHidden) { #
                <div class="filter_flex_item" data-desckeyid="#: DescriptionKeyId #">
                    #if(typeof(DataType) !== 'undefined') {#
                    # if(DataType == "VALUE") {#
                    <div class="filter_info_flex_item">
                        <div onClick="g_showDkgInFilterlist(#:DescriptionKeyGroupId#)" class="dk-filter-heading"><b>#: KeyName #:</b></div>
                        <div>#: DataValue # </div>
                    </div>
                    <div class="delete_flex_item">
                        <div><a data-bind="events {click: remove}" class="k-button k-delete-button"><span class="k-icon k-i-delete"></span></a></div>
                    </div>
                    #} else if(DataType == "GROUPING") {#
                    <div class="filter_info_flex_item">
                        <div class="dk-filter-heading"><b>#: DescriptionKeyGroupName #:</b></div>
                        <div>#: KeyName # </div>
                    </div>
                    <div class="delete_flex_item">
                        <div><a data-bind="events {click: remove}" class="k-button k-delete-button"><span class="k-icon k-i-delete"></span></a></div>
                    </div>
                    #} else if(DataType == "TAXLEVEL") {#
                    <div class="filter_info_flex_item">
                        <div class="dk-filter-heading"><b>#: DescriptionKeyGroupName #:</b></div>
                        <div>#: KeyName # </div>
                    </div>
                    <!--dd><a data-bind="events {click: remove}" class="k-button k-delete-button"><span-- class="k-icon k-i-delete"></span></a></dd-->
                    #} else {#
                    <div class="filter_info_flex_item">
                        <div class="dk-filter-heading" onClick="g_showDkgInFilterlist(#:DescriptionKeyGroupId#)"><b>#: DescriptionKeyGroupName #:</b></div>
                        <div>#: KeyName # </div>
                    </div>
                    <div class="delete_flex_item">
                        <div><a data-bind="events {click: remove}" class="k-button k-delete-button"><span class="k-icon k-i-delete"></span></a></div>
                    </div>
                    # } #
                    # } #
                </div>
                # } else { #
                    <!-- kendo view-data sync hack - screw u kendo! -->
                    <dl style="display:none;"></dl>
                # } #
                # } #
            </script>

            <script>
                var viewModel_queryFilters = kendo.observable({
                    isVisible: false,
                    queryFilters_DataSource: {
                        schema: {
                            model: QueryFilter
                        },
                    },
                    updateFilterList: function (selectedItems) {
                        var queryFiltersArr = [];
                        selectedItems.forEach(function (queryFilter) {
                            queryFiltersArr.push(queryFilter);
                        });
                        this.set("queryFilters_DataSource", queryFiltersArr);
                    },
                    remove: function (e) {
                        if (e.data.isDeletable) {
                            this.queryFilters_DataSource.remove(e.data);
                            var updatedSelItems = viewModel_dkg_pb.get("selectedItems");
                            updatedSelItems.forEach(function (selItem, index) {
                                if (selItem.DescriptionKeyId == e.data.DescriptionKeyId && selItem.DescriptionkeyGroupId == e.data.DescriptionkeyGroupId) {
                                    delete updatedSelItems[index];
                                }
                            });
                            viewModel_dkg_pb.set("selectedItems", updatedSelItems);
                            g_dk_FilterRemovedEvent(viewModel_dkg_pb.get("selectedItems"));
                        } else {
                            console.log("non-deletable item:");
                            console.log(e);
                        }
                    }
                });

                kendo.bind($("#dkFilterListView"), viewModel_queryFilters);

            </script>
				
			</div>
			<div class="filter_wrap flex_item">
				<h3>Merkmalsfilter</h3>
				<!-- TabStrip -->
				<div class="region_wrap flex_item">
					<h4>Körperregion</h4>
					<div id="tab_listView" class="tab">
						<div class="k-content wide">
							<div data-role="listview"
								 data-bind="source: dataSource, visible: isVisible, events: { dataBound: dkgsBound }"
								 data-template="tab_items_template">
							</div>
						</div>
					</div>
					<script type="text/x-kendo-tmpl" id="tab_items_template">
						# if(typeof(AllChildIds) == 'object' && AllChildIds.length >= 1) { #
						<button class="k-widget primary cat-tooltip" data-bind="click: addFilterDescriptionKeyGroups" data-tooltip="#:AllChildNames.join(',')#" data-target="#:Id#" data-parentids="#:AllChildIds.join(',')#">
							# } else { #
							<button class="k-widget primary" data-bind="click: addFilterDescriptionKeyGroups" data-target="#:Id#">
								# } #
								#:DkgName#
							</button>
					</script>	
					<script>
						viewModel_dkg_tabs = new kendo.observable({
							dataSource: keyGroup_DataSource_tabs,
							isVisible: false,
							activeDkgs: null,
							itemSelectorStr: "#tab_listView>.k-content>div[data-role=listview]>button.k-widget",
							updateActiveTabs: function () {
								var that = this;
								if (that.get("activeDkgs") != null) {
									$(that.itemSelectorStr).addClass('state-hidden');
									that.activeDkgs.forEach(function (key, val) {
										//$(that.itemSelectorStr + "[data-target="+gVM.keyGroup_DataSource_full.get(val).get("ParentDescriptionKeyGroupId")+"]").removeClass('state-hidden');
										if (typeof (keyGroup_DataSource_full.get(val)) !== 'undefined') {
											$(that.itemSelectorStr + "[data-parentids*=" + keyGroup_DataSource_full.get(val).get("ParentDescriptionKeyGroupId") + "]").removeClass('state-hidden');
										}
									});
									//"Alle" needs to be activated since it's not in db
									$(that.itemSelectorStr + "[data-target=-1]").removeClass('state-hidden');
								}
							},
							addFilterDescriptionKeyGroups: function (e) {
								//var filterDkgId = e.data.Id;
								var filterDkgId = $(e.originalEvent.target).closest("button").data("parentids");
								var $butt = $(e.originalEvent.target).closest("button");
								$(this.itemSelectorStr).removeClass("state-active");
								$butt.addClass('state-active');
								if (typeof (filterDkgId) == 'undefined') {
									filterDkgId = $(e.originalEvent.target).closest("button").data("target");
								}
								if (typeof (filterDkgId !== 'undefined') && !$(e.originalEvent.target).closest("button").hasClass('k-state-disabled')) {
									var t = setTimeout(function () {
										g_dkg_UpdateAll(filterDkgId);
									}, 600);
								}
							},
							/*** ADD ALLE Item **/
							dkgsBound: function () {
								var dataSource = this.dataSource;
								var data = dataSource.data();
								if (!this._adding) {
									this._adding = true;

									data.splice(0, 0, {
										"Id": -1,
										"DkgName": "Alle",
										"ParentIds": -1,
										"DkgParentName": null
									});
									$(this.itemSelectorStr).first().addClass("state-active");
									this._adding = false;
								}
							},
						});

						kendo.bind($("#tab_listView"), viewModel_dkg_tabs);
					</script>

					<!-- TEMPLATES -->
					<script id="li-template" type="text/x-kendo-template">
						<li data-bind="text: KeyName">
							#: kendo.ToString(get("KeyName")) #
						</li>
					</script>
					<div style="clear:both;"></div>
				</div>



					<!-- Lage -->
					<div class="position_gender_wrap flex_item">
						<div class="position_wrap">
							<h4>Lage am Körper</h4>
							<div id="positionDropdown">
								<div class="dkg-section k-content">
									<input id="positionLevel"
										   data-role="dropdownlist"
										   data-text-field="KeyGroupName"
										   data-value-field="DescriptionKeyGroupId"
										   data-bind="source: dataSource, visible: isVisible" />
								</div>
								
								<script id="position_dropdown_template" type="text/x-kendo-template">
									<span>
										#: KeyGroupName #
									</span>
								</script>
								<script type="text/javascript">
									var posDrop = $("#positionDropdown").kendoDropDownList({
										dataTextField: "KeyGroupName",
										initBound: false,
										_adding: false,
										dataValueField: "DescriptionKeyGroupIds",
										template: kendo.template($("#position_dropdown_template").html()),
										dataSource: {
											transport: {
												read: {
													dataType: "json",
													url: g_crudServiceBaseUrl + "/descriptionKeyGroups/positions",
												}
											},
										},
										select: g_onPositionSelect,
										dataBound: function () {
											if (!this.initBound) {
												var dataSource = this.dataSource;
												console.log(this.dataSource);
												var data = dataSource.data();
												if (!this._adding) {
													this._adding = true;
													data.splice(0, 0, {
														"DescriptionKeyGroupIds": -1,
														"KeyGroupName": "Keine Auswahl",
														"ChildrenDescriptionKeyGroupIds": -1
													});

													this._adding = false;
													this.select(0);
												}
												this.initBound = true;
											}
										}
									});
									var positionDrop = $("#positionDropdown").data("kendoDropDownList");

									function g_onPositionSelect(e) {
										/** Disabled - filtering only on client-side
										if (typeof (e.dataItem.ChildrenDescriptionKeyGroupIds) !== 'undefined') {
											var posQF = g_createPositionQueryFilter(e.dataItem);
											viewModel_dkg_pb.selectedItems[posQF.DescriptionKeyGroupId + ";" + posQF.DescriptionKeyGroupId] = posQF;
											g_updateAll();
										}
										**/
										if (typeof (e.dataItem) !== 'undefined') {
											var filterDkgIds = [];
											var cdkgs = e.dataItem.ChildrenDescriptionKeyGroupIds;
											if (cdkgs !== -1) {
												cdkgs.forEach(function (key, val) {
													filterDkgIds.push(key);
												});
											} else {
												filterDkgIds = null;
											}
											viewModel_dkg_pb.set("positionFilter", filterDkgIds);
											viewModel_dkg_pb.updateFilter();
										}
									}

									function g_createPositionQueryFilter(dataItem) {
										var dkgIds = dataItem.DescriptionKeyGroupIds;
										var posQF = new QueryFilter();
										//sorry for abuse
										posQF.KeyName = dataItem.KeyGroupName;
										posQF.DescriptionKeyId = "Position";
										posQF.DescriptionKeyGroupId = "Position";
										posQF.DescriptionKeyGroupName = "Lage";
										posQF.DataType = "POSITION";
										posQF.DataValue = dkgIds;
										return posQF;
									}
								</script>
							</div>

						</div>

						<!-- M/W -->
						<div class="gender_wrap">
							<h4>Geschlecht</h4>
							<div id="genderDropdown">
								<div class="dkg-section k-content">
									<input id="genderLevel"
										   data-role="dropdownlist"
										   data-text-field="DescriptionKeyTypeName"
										   data-value-field="DescriptionKeyTypeId"
										   data-bind="source: dataSource,
									  visible: isVisible" />
								</div>

								<script id="gender_dropdown_template" type="text/x-kendo-template">
									<span>
										#: DescriptionKeyTypeName #
									</span>
								</script>
								<script type="text/javascript">
									$("#genderDropdown").kendoDropDownList({
										dataTextField: "DescriptionKeyTypeName",
										initBound: false,
										dataValueField: "DescriptionKeyTypeId",
										template: kendo.template($("#gender_dropdown_template").html()),
										dataSource: {
											transport: {
												read: {
													dataType: "json",
													url: g_crudServiceBaseUrl + "/taxonDescriptions/gender",
												}
											},
										},
										select: g_onGenderSelect,
										dataBound: function () {
											if (!this.initBound) {
												this.initBound = true;
												var dataSource = this.dataSource;
												var data = dataSource.data();
												console.log("data:");
												console.log(data);
												//per customer request 2020-09-21: removed Männchen&Weibchen from selection
												data.splice(0,1);
												/**
												data.forEach(function (it, ix) {
													if (it.DescriptionKeyTypeName.indexOf(";") > -1) {
														it.DescriptionKeyTypeName = it.DescriptionKeyTypeName.replace(";", " &");
														data[ix].delete();
													}
												});
												**/

												if (!this._adding) {
													this._adding = true;
													data.splice(0, 0, {
														"DescriptionKeyTypeId": -1,
														"DescriptionKeyTypeName": "Keine Auswahl",
													});

													this._adding = false;
													this.select(0);
												}
											}
										}
									});
									var genderDrop = $("#genderDropdown").data("kendoDropDownList");

									function g_onGenderSelect(e) {

										if (typeof (e.dataItem) !== 'undefined') {
											console.log("position selected");

											var genderId = e.dataItem.DescriptionKeyTypeId;
											var filterDkgIds = [];
											if (typeof (genderId) === "object") {
												genderId.forEach(function (key, val) {
													filterDkgIds.push(key);
												});
												viewModel_dkg_pb.set("genderFilter", filterDkgIds);
											} else if (genderId == -1) {
												viewModel_dkg_pb.set("genderFilter", null);
											} else {
												viewModel_dkg_pb.set("genderFilter", genderId);
											}
											console.log(viewModel_dkg_pb.get("genderFilter"));
											viewModel_dkg_pb.updateFilter();
										}
									}

								</script>
							</div>
						</div>
					</div>

					<!-- Ampel -->
						<div class="ampel_wrap flex_item">
							<h4>Ampel</h4>
							<div id="ampelDropdown">
								<div class="dkg-section k-content">
									<input id="ampelLevel"
										   data-role="dropdownlist"
										   data-text-field="VisibilityCategoryName"
										   data-value-field="VisibilityCategoryId"
										   data-bind="source: dataSource,
									  visible: isVisible" />
								</div>

								<script id="ampel_dropdown_template" type="text/x-kendo-template">
									<span title="#: DisplayName #">
										#: VisibilityCategoryName #
									</span>
								</script>
								<script type="text/javascript">
									$("#ampelDropdown").kendoDropDownList({
										dataTextField: "VisibilityCategoryName",
										initBound: false,
										dataValueField: "VisibilityCategoryId",
										template: kendo.template($("#ampel_dropdown_template").html()),
										dataSource: {
											transport: {
												read: {
													dataType: "json",
													url: g_crudServiceBaseUrl + "/descriptionKeyGroups/viscats",
												}
											},
										},
										select: g_onAmpelSelect,
										dataBound: function () {
											if (!this.initBound) {
												this.initBound = true;
												var dataSource = this.dataSource;
												var data = dataSource.data();
												if (!this._adding) {
													this._adding = true;
													data.splice(0, 0, {
														"VisibilityCategoryId": -1,
														"VisibilityCategoryName": "Keine Auswahl",
														"DisplayName": "Keine Auswahl",
													});

													this._adding = false;
													this.select(0);
												}
											}
										}
									});
									var ampelDrop = $("#ampelDropdown").data("kendoDropDownList");
									function g_onAmpelSelect(e) {
										console.log("on ampel select");
										console.log(e);
										if (typeof (e.dataItem) !== 'undefined') {
											var ampelId = e.dataItem.VisibilityCategoryId;
											if (ampelId == -1) {
												viewModel_dkg_pb.set("ampelFilter", null);
											} else {
												viewModel_dkg_pb.set("ampelFilter", ampelId);
											}
											viewModel_dkg_pb.updateFilter();
										}
										console.log(viewModel_dkg_pb.get("ampelFilter"));
									}

								</script>
							</div>
						</div>
					</div>				
			</div>

					<!-- PANELBAR -->
					<div class="panelbar_wrap flex_item">
					<h3 id="desckey_h4_header">Merkmalsabfrage</h3>
					<div id="dkg_panelbar_flex_item">
						<div class="loading_layer"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
						<div class="demo-section k-content">
							<div>
								<div id="dkg_panelbar"
									 class="dkg_panelbar"
									 data-role="panelbar"
									 data-load-on-demand="false"
									 data-text-field="KeyGroupName"
									 data-expand-mode="multiple"
									 data-template="panelbar_dkg_template"
									 data-bind="visible: isVisible,
												source: data,
												events: { select: onSelect,
														expand: onExpand,
														bind: onBind,
														contentLoad: onContentLoad
												}">
								</div>
							</div>
						</div>
						<script id="panelbar_dk_template" type="text/kendo-ui-template">
							<div class="dk_image_flex_item image_PIC">
							</div>
						</script>
						<script id="panelbar_dkg_template" type="text/kendo-ui-template">
							#var pic_array = new Array();#
							# if (item.DescriptionKey) { #
								<!-- KeyGroup-Level -->
								#var dkgtype = JSON.parse(item.DescriptionKeyGroupType);#
								#var dkgtype_classname = "default";#
								#if(dkgtype){if(dkgtype.length>0) {var dkgtype_classname = dkgtype.join("-");}}#
									# var ampel_wert = "";
									  if(item.VisibilityCategoryId == 1) {ampel_wert = "Tot, meist mit Präparation, mit min. 40x Auflichtmikroskop oder anderen Mikroskopiertechniken";}
									  else if(item.VisibilityCategoryId == 2) {ampel_wert = "Lebend/tot, ohne Präparation, mit 20x Auflichtmikroskop oder guter Makroaufname";}
									  else if(item.VisibilityCategoryId == 3) {ampel_wert = "Lebend, ohne Präparation, mit Auge bis 10x Lupe oder Foto";}
									  else {ampel_wert = "Keine Ampelfarbe";} #
								# if(item.DescriptionKeyGroupDataType == "PIC") { #
									<div class="pb-item-header-wrap" onclick="initCarousel($(this));">
										<span data-desckeygroupid="#: item.DescriptionKeyGroupId #"> #: item.KeyGroupName # </span><span class="dkg_info_wrap"><i title="#:ampel_wert#" class="ampel-#:item.VisibilityCategoryId#"></i>&nbsp;|&nbsp;<i title="Geschlecht" class="fas dkgtype-#:dkgtype_classname#"></i>&nbsp;|&nbsp;<i class="fas fa-arrows-alt" title="#=g_getLageRegionByParentDKGId(item.ParentDescriptionKeyGroupId)#"></i></span>
									</div>
								# } else { #
									<div class="pb-item-header-wrap">
										<span data-desckeygroupid="#: item.DescriptionKeyGroupId #"> #: item.KeyGroupName # </span><span class="dkg_info_wrap"><i title="#:ampel_wert#" class="ampel-#:item.VisibilityCategoryId#"></i>&nbsp;|&nbsp;<i title="Geschlecht" class="fas dkgtype-#:dkgtype_classname#"></i>&nbsp;|&nbsp;<i class="fas fa-arrows-alt" title="#=g_getLageRegionByParentDKGId(item.ParentDescriptionKeyGroupId)#"></i></span>
									</div>
								# } #
							# } else { #
							<!-- Key-Level -->
							# if (item.DescriptionKeyId) { #
							# var dkType = g_getDataTypeByDKId(item.DescriptionKeyId); #
							# if (dkType === "VALUE") { #
							<div class="dk_value_wrapper">
								<span class="dk_list_item" data-desckeyid="#: item.DescriptionKeyId #">#: item.KeyName #</span>
								<div style="min-height:75px;">
									<div class="dk_value" id="dk_value-#:kendo.toString(item.DescriptionKeyId)#" data-desckeygroupid="#= kendo.toString(item.DescriptionKeyGroupId) #" data-desckeyid="#= kendo.toString(item.DescriptionKeyId) #" data-desckeyname="#= kendo.toString(item.KeyName) #">
										<!-- events point to wrapping viewModel_dkg_pb -->
										<!-- input will be re-created on init - fallback below -->
										<input 
											   id="data_value_#=kendo.toString(item.DescriptionKeyId)#"
											   data-role="numerictextbox"
											   data-format="n0"
											   data-min="#= g_getSliderValue(item.DescriptionKeyId, false)#"
											   data-max="#= g_getSliderValue(item.DescriptionKeyId, true)#"
											   data-desckeyid="#= kendo.toString(item.DescriptionKeyId) #"
											   data-step="1"
											   data-desckeygroupid="#= kendo.toString(item.DescriptionKeyGroupId) #"
											   data-desckeyname="#=kendo.toString(item.KeyName)#"
											   data-bind="visible: isVisible,
															   enabled: isEnabled,
															   value: selectedNumber" />
										<button data-role="button"
											  data-desckeygroupid="#= kendo.toString(item.DescriptionKeyGroupId) #"
											  data-target = "\#data_value_#=kendo.toString(item.DescriptionKeyId)#"
                    						  data-bind="visible: isVisible, enabled: true, 
												events: { click: onChangeDkValue }"
                    						  style="width: 180px"
            							>Ok</button>
									</div>
								</div>
							</div>
							# } else if(dkType === "PIC") { #
							<!-- PIC -->
							<div data-type="#=dkType#" title="Merkmal auswählen" style="cursor:default;" class="heading_flex_item">
								<span class="dk_list_item" data-desckeyid="#:item.DescriptionKeyId#"> #: item.KeyName #</span>
								# if(is_touch_device()) {#
									<span class="touch_hint"><i class="fa fa-info-circle" aria-hidden="true"></i><span class="touch_hint_text">&nbsp;Auswahl durch zwei Mal klicken</span></span>
								#}#
							</div>
							# } else { #
							<!-- VALUELIST -->
							<div data-type="#=dkType#" title="Merkmal auswählen" class="heading_flex_item">
								<span class="dk_list_item" data-badgevalue="#:item.BadgeValue#" data-desckeyid="#: item.DescriptionKeyId #">#: item.KeyName #</span>
									# if(item.KeyDescription != null) { #
										&nbsp;<i title="#:item.KeyDescription#" class="fas fa-info-circle"></i>
									# } #
								</span>
								<span class="badge">#:item.BadgeValue#</span>
							</div>
							# } #

							# if(item.ListSourceJson != null) { #
							# var objList = JSON.parse(item.ListSourceJson); #
							# if(objList != null) { #
							# var wrapper_width = parseInt(Math.floor(objList.length/4) * 100)+"%";#
							<div class="dk_image_flex_item image_#=dkType# wrapper">
								#if(dkType !== 'PIC') {#
								# for (var i = 0; i < objList.length; i++) { #
								# var sourceStr = g_imagePath+objList[i].trim()+".jpg"; #
								# var widthStr = "calc("+parseFloat(100/objList.length)+"% - 10px);";#
								<figure>
									<a class="swipeLink" title="Bilder vergrößern" href="#=sourceStr#">
										<img data-type="#=dkType#" onclick="initPhotoSwipeFromDOM('.dk_image_flex_item');" onload="g_setDataAttributes($(this))" onerror="this.src='https://via.placeholder.com/112x150.jpg?text=Bild+wird+nachgereicht'" class="lazy_dk_image image_#=dkType#" data-src="#=sourceStr#" alt="#=objList[i]#">
									</a>
								</figure>
								#}#
								#} else {#
									<div class="slide_flex_item">
										# for (var i = 0; i < objList.length; i++) { #
										# var part = parseInt(i/4); var partBefore = parseInt(part-1); var partNext = parseInt(part+1); var partLast = Math.floor(objList.length / 4)#
										# var sourceStr = g_imagePath+objList[i].trim()+".jpg"; #
										# var widthStr = "calc("+parseFloat(100/objList.length)+"% - 10px);";#
										<div class="item">
											<figure>
												<a class="swipeLink" title="Bild auswählen" style="cursor:pointer;" target="_blank" href="#=sourceStr#">
													<!-- div>#:keyGroup_DataSource_full.options.pic_dk_source_map.get(objList[i].trim())#</ div-->
													#var pic_dk = keyGroup_DataSource_full.options.pic_dk_source_map.get(objList[i].trim()); #
													#var pic_dkName = keyGroup_DataSource_full.options.pic_dk_keyname_map.get(objList[i].trim()); #
													<img data-desckeygroupid="#: item.DescriptionKeyGroupId #" data-type="#=dkType#" data-desckeyid="#:pic_dk#" data-keyname="#:pic_dkName#" onclick="viewModel_dkg_pb.onSelectPic($(this));" onload="g_setDataAttributes($(this))" onerror="this.src='https://via.placeholder.com/112x150.jpg?text=Bild+wird+nachgereicht'" class="lazy_dk_image image_#=dkType#" data-src="#=sourceStr#" alt="#=objList[i]#">
												</a>
											</figure>
										</div>
										# } #
									</div>
									<div class="pic_caption_flex_item"></div>
								# } #
							</div>
							#}#
							#}#
							#}#
							# } #
							#if(pic_array.length < 0) {#
							<!-- span class="k-link"></!--span -->
							<div data-type="#=dkType#" class="heading_flex_item" title="Merkmal auswählen">
								<div class="dk_image_flex_item image_pic">
									# for (var i = 0; i < pic_array.length; i++) { #
									# var sourceStr = g_imagePath+pic_array[i].trim()+".jpg"; #
									# var widthStr = "calc("+parseFloat(100/pic_array.length)+"% - 10px);";#
									<figure><a class="swipeLink"  title="Bilder vergrößern" href="#=sourceStr#"><img data-type="#=dkType#" data-desckeyid="#:item.DescriptionKeyId#" onload="g_setDataAttributes($(this))" onerror="this.src='https://via.placeholder.com/112x150.jpg?text=Bild+wird+nachgereicht'" class="lazy_dk_image image_pic" data-src="#=sourceStr#" alt="#=pic_array[i]#"></a></figure>
									# } #
								</div>
							</div>
							#}#
						</script>
						<script>
							function renderDKPICTemplate(data) {
								return kendo.Template.compile($('#panelbar_dk_template').html())(data);
							}

							var viewModel_dkg_pb = kendo.observable({
								isVisible: true,
								data: keyGroup_DataSource_full,
								//selectedItems = Map if radio-type selection, Array if checkbox-like
								selectedItems: new Object(),
								//will be set through dropdowns (Merkmalsfilter)
								regionFilter: null,
								positionFilter: null,
								genderFilter: null,
								ampelFilter: null,
								queryTaxLevel: null,
								sliderVals: null,
								selectedDKG: null,
								dkWhitelist: null,
								badgesList: null,
								onContentLoaded: function (e) {
									/**
									console.log("content loaded");
									console.log(this.pic_array);
									**/
								},
								ripOrder: null,
								pic_array: new Array(),
								busyUpdating: false,
								addDKGIdFilter: function (dkgFilterArr) {
									if (typeof (dkgFilterArr) === 'object') {
										var _flt_sub = { logic: "or", filters: [] };
										dkgFilterArr.forEach(function (dkgFilterItem) {
											_flt_sub.filters.push({ field: "DescriptionKeyGroupId", operator: "eq", value: dkgFilterItem });
											_flt_sub.filters.push({ field: "ParentDescriptionKeyGroupId", operator: "eq", value: dkgFilterItem });
										});
										return _flt_sub;
									} else {
										return null;
									}
								},
								addDKGTypeIdFilter: function (dkgTypeFilterArr) {
									var _flt_sub = { logic: "or", filters: [] };
									if (dkgTypeFilterArr !== null) {
										if (typeof (dkgTypeFilterArr) === 'object') {
											dkgTypeFilterArr.forEach(function (dkgFilterItem) {
												_flt_sub.filters.push({ field: "DescriptionKeyGroupType", operator: "contains", value: JSON.stringify(dkgFilterItem) });
											});

										} else {
											_flt_sub.filters.push({ field: "DescriptionKeyGroupType", operator: "contains", value: JSON.stringify(dkgTypeFilterArr) });
										}
									}
									return _flt_sub;
								},
								addDKGAmpelFilter: function (ampelId) {
									var _flt_sub = { logic: "or", filters: [] };
									if (ampelId !== null) {
										_flt_sub.filters.push({ field: "VisibilityCategoryId", operator: "contains", value: ampelId });
									}
									return _flt_sub;
								},
								updateFilter: function () {
									var _fltMain = [];
									var _flt = { logic: "and", filters: [] };
									if (this.regionFilter != null) {
										var fil = this.addDKGIdFilter(this.regionFilter);
										_flt.filters.push(fil);
									}
									if (this.positionFilter != null) {
										var fil = this.addDKGIdFilter(this.positionFilter);
										_flt.filters.push(fil);
									}
									if (this.ampelFilter != null) {
										var fil = this.addDKGAmpelFilter(this.ampelFilter);
										console.log(fil);
										_flt.filters.push(fil);
									}
									if (this.genderFilter != null) {
										var fil = this.addDKGTypeIdFilter(this.genderFilter);
										console.log(fil);
										_flt.filters.push(fil);
									} else {
										_flt.filters.push({ field: "DescriptionKeyGroupDataType", operator: "isnotnull" });
									}
									if (_flt.filters[0] == null) {
										_flt = { logic: "and", filters: [] };
										_flt.filters.push({ field: "DescriptionKeyGroupDataType", operator: "isnotnull" });
									}
									console.log("always push original filter additionaly");
									//always push original filter additionaly
									_flt.filters.push({ field: "RipValue", operator: "isnotnull" });
									
									_fltMain.push(_flt);
									this.data.query({ filter: _fltMain });
									this.data.sort({ field: "OrderPriority", dir: "asc" },{ field: "RipValue", dir: "asc" },{field: "DescriptionKey.BadgeValue", dir: "asc"});
									this.loadVisibleImages();
									this.updateAllInfo();
								},
								showDkg: function (dkg) {
									var $targetDkg = $(this.dkg_list_item_selector + "[data-desckeygroupid='" + dkg + "']");
									if (!$targetDkg.closest('li.k-item').hasClass('k-state-active')) {
										$targetDkg.click();
									}
									//$("html, body").animate({ scrollTop: $targetDkg.offset().top - 100 }, 600, 'swing');
								},
								onSelectPic: function ($item) {
									var that = this;
									if (!$item.hasClass('k-state-disabled') && ((is_touch_device() && $item.hasClass("ticked"))) || (!is_touch_device())) {
										var t = setTimeout(function () {
											that.busyUpdating = true;
											var qFilter = new QueryFilter();
											qFilter.DescriptionKeyId = $item.data('desckeyid');
											qFilter.DescriptionKeyGroupId = $item.data('desckeygroupid');
											qFilter.KeyName = $item.data('keyname');
											qFilter.DescriptionKeyGroupName = g_getKeyGroupNameByDKGId(qFilter.DescriptionKeyGroupId);
											qFilter.DataType = g_getDataTypeByDKGId(qFilter.DescriptionKeyGroupId);
											qFilter.DataValue = null;
											viewModel_dkg_pb.selectedItems[qFilter.DescriptionKeyGroupId + ";" + qFilter.DescriptionKeyId] = qFilter;
											//notify filter list + ajax request
											g_updateAll();
											that.busyUpdating = false;
										}, 500);
									}

									if (is_touch_device()) {
										$item.closest(".dk_image_flex_item.image_PIC.wrapper").find(".lazy_dk_image.image_PIC").removeClass("ticked");
										$item.addClass("ticked");
									}
								},
								onChangeDkValue: function (e) {
									if (this.busyUpdating === false) {
										var that = this;
										var $item = e.sender.element;
										var data_val = null;
										if(typeof($item.data("target") !== 'undefined')){
											var target = $item.data("target");
											var numerictextbox = $(target).data("kendoNumericTextBox");
											data_val = numerictextbox.value();
										}
										//$item.closest('.k-slider').addClass('k-state-disabled');
										//delay to avoid getting caught in update loop
										var t = setTimeout(function () {
											that.busyUpdating = true;
											var qFilter = new QueryFilter();
											qFilter.DescriptionKeyId = $item.closest('.dk_value').data('desckeyid');
											qFilter.DescriptionKeyGroupId = $item.closest('.dk_value').data('desckeygroupid');
											qFilter.KeyName = $item.closest('.dk_value').data('desckeyname');
											qFilter.DescriptionKeyGroupName = g_getKeyGroupNameByDKGId(qFilter.DescriptionKeyGroupId);
											qFilter.DataType = g_getDataTypeByDKGId(qFilter.DescriptionKeyGroupId);
											qFilter.DataValue = data_val || e.value;
											viewModel_dkg_pb.selectedItems[qFilter.DescriptionKeyGroupId + ";" + qFilter.DescriptionKeyId] = qFilter;
											//notify filter list + ajax request
											g_updateAll();
											that.busyUpdating = false;
											$item.closest('.k-slider').removeClass('k-state-disabled');
										}, 100);
									}
								},
								dkg_list_item_selector: "#dkg_panelbar > div.k-content > div > div > li.k-item > span > div > span",
								dk_list_item_selector: "#dkg_panelbar>li.k-item>ul.k-group>li.k-item span.dk_list_item",
								dk_pic_list_item_selector: "#dkg_panelbar > li.k-item > ul > li > span > div.dk_image_flex_item.image_PIC div.item img.image_PIC",
								updateSelectedItems: function (selectedItemsMap) {
									this.isVisible = false;
									for (var member in Object.keys(this.selectedItems)) {
										if (typeof (this.selectedItems[member]) !== 'undefined') {
											console.log(this.selectedItems[member]);
											if (this.selectedItems[member].isDeletable) {
												delete this.selectedItems[member];
											}
										}
									}
									this.set("selectedItems", selectedItemsMap);
									var t = setTimeout(function () {
										$("#dkg_panelbar_flex_item .dkg_panelbar>li.k-item[role='menuitem'] .k-state-selected").removeClass('k-state-selected');
									}, 200);
									this.isVisible = true;
								},
								onExpand: function (e) {
									var $dk_images = $(e.item).find('img');
									$dk_images.each(function () {
										//pass dom element
										g_preloadImage($(this)[0]);
									});
								},
								updateBadges: function () {
									var that = this;
									//hide all dk listitems, show only those with values >= 0
									//$(that.dk_list_item_selector).closest('li.k-item').hide();
									$(that.dk_list_item_selector).closest('li.k-item').removeClass('k-state-disabled');
									$(that.dk_pic_list_item_selector).closest('li.k-item').removeClass('k-state-disabled');
									if (this.badgesList) {
										//var dk_list_item_selector = "#dkg_panelbar_flex_item .dkg_panelbar>li.k-item>ul.k-group>li.k-item span.dk_list_item";
										this.badgesList.forEach(function (key, val) {
											$dk_list_item = $(that.dk_list_item_selector + "[data-desckeyid=" + val + "]");
											$dk_pic_list_item = $(that.dk_pic_list_item_selector + "[data-desckeyid=" + val + "]");
											
											$dk_list_item.siblings('.badge').text(key);
											$dk_list_item.siblings('.datatypePic').find('.badge').text(key);
											$dk_pic_list_item.siblings('.badge').text(key);
											$dk_pic_list_item.siblings('.datatypePic').find('.badge').text(key);
											
											var dataItem = that.data.getByUid($dk_list_item.closest('li.k-item').data("uid"));
											
											if(typeof(dataItem) !== 'undefined') {
												dataItem.set("BadgeValue", key);													
											}
											
											/*
											if(key === 0) {
												console.log("found one: ");
												console.log($dk_list_item.closest('li.k-item'));
												$dk_list_item.closest('li.k-item').addClass('k-state-disabled');
												$dk_pic_list_item.closest('li.k-item').addClass('k-state-disabled');
											}
											*/
											
											//console.log($dk_list_item);
											//console.log($dk_list_item.closest('li.k-item'));
											//$dk_list_item.closest('li.k-item').show();
											//$dk_pic_list_item.closest('li.k-item').show();
										});
										
										that.setSort();
										
										$("[data-badgevalue='null']").each(function () {
											$(this).closest("li.k-item").hide();												
										});
											
										$("[data-badgevalue='0']").each(function () {
											$(this).closest("li.k-item").addClass("k-state-disabled");
										});
										
									}
									
								},
								updateRipValues: function () {
									var that = this;
									if (this.ripOrder !== null) {
										var datasourcedata = this.get("data");
										//loving data
										var datasourcedatadata = datasourcedata.data();
										datasourcedatadata.forEach(function (dItem) {
											dItem.RipValue = null;
										});
										Object.keys(that.ripOrder).forEach(function (ripItem) {
											var dataItem = datasourcedata.get(ripItem);
											if (typeof (dataItem) !== 'undefined') {
												dataItem.RipValue = that.ripOrder[ripItem];
											}
										});
										//move selected DKGs to top
										this.selectedItems.forEach(function (selItem) {
											if (typeof (selItem.DataType) !== 'undefined') {
												if (selItem.DataType !== 'GROUPING' && selItem.DataType !== 'TAXLEVEL' && selItem.DataType !== 'TLF' && selItem.DataType !== 'LLF' && selItem.DataType !== 'GGF' && selItem.DataType !== 'POSITION' && selItem.DataType !== 'GENDER') {
													var dataItem = datasourcedata.get(selItem.DescriptionKeyGroupId);
													dataItem.RipValue = -99;
													//TODO: fix!
													//$(that.dkg_list_item_selector + "[data-desckeygroupid=" + dataItem.DescriptionKeyGroupId + "]").closest('.k-item').addClass('hussassaa');
												}

											}
										});
									}
								},
								updateAllInfo: function () {
									this.updateBadges();
									this.disableZeroDks();
								},
								setSort: function setSort(){
									var items = $("#dkg_panelbar").data("kendoPanelBar").dataSource.data();
									//console.log(items);
								  	for(var i=0; i < items.length; i++){

										if(items[i].hasChildren) {
												if(items[i].DescriptionKey) {
													items[i].DescriptionKey.sort(function (a,b) {
													console.log(a);
													return b.BadgeValue - a.BadgeValue;
												});
													console.log(items[i].DescriptionKey);
												}
											items[i].children.sort({field: "BadgeValue", dir: "desc"});
									} else {
										//items[i].sort({field: "DescriptionKeyId", dir: "asc"});
									}
								  }
								},
								applyFilter_dkg: function (payloadArr) {
									if (typeof (payloadArr.Item2) !== 'undefined') {

										var that = this;
										var _fltMain = [];

										this.updateRipValues();

										var _flt = { logic: "and", filters: [] };
										//this.data.query({ filter: _fltMain });
										_flt.filters.push({ field: "RipValue", operator: "isnotnull" });

										//remove selected keygroups from panelbar
										this.selectedItems.forEach(function (item) {
											//_flt.filters.push({ field: "DescriptionKeyGroupId", operator: "neq", value: item.DescriptionKeyGroupId });
										});

										//Sorting part for most cases
										this.data.query({ filter: _flt });
										this.data.sort([{field: "DescriptionKey.BadgeValue", dir: "asc"},{ field: "VisibilityCategoryId", dir: "desc" },{ field: "OrderPriority", dir: "asc" },{ field: "RipValue", dir: "asc" }]);										
										//dataSource.view()
										//this.setSort();
										//disable description key dom elements

										//iterate all doms - set all active and get desckeyids
										/**
										$(that.dk_list_item_selector).map(function () {
											if (that.dkWhitelist.hasOwnProperty($(this).data('desckeyid'))) {
												$(this).closest('li.k-item').removeClass('k-state-disabled');
											} else {
												$(this).closest('li.k-item').addClass('k-state-disabled');
											}
											return $(this).data('desckeyid');
										});
										**/
										this.disableZeroDks();

										//collapse all
										//customer request: dont auto collapse 2021-12-23
										//$("#dkg_panelbar").data("kendoPanelBar").collapse($("li", "#dkg_panelbar"));
										//hack to deselect all clicked panel items and only show selected ones -- TODO: find source of error
										var t = setTimeout(function () {
											$("#dkg_panelbar_flex_item .dkg_panelbar>li.k-item[role='menuitem'] .k-state-selected").removeClass('k-state-selected');
											//@TODO: check dkg_dkg_list_item_selector
											that.selectedItems.forEach(function (item) {
												if (item.DataType !== 'VALUE') {
													$(that.dk_list_item_selector + "[data-desckeyid='" + item.DescriptionKeyId + "']").closest("span.k-link").addClass('state-selected-steady');
												}
												$("#dkg_panelbar > li.k-item > span > div > span[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").closest("span.k-link").addClass('state-selected-steady-dkg').removeClass('k-state-active');
												console.log($("#dkg_panelbar > li.k-item > span > div > span[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").closest("span.k-link"));
												//$(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").addClass('state-selected-steady-dkg');
												if ($(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").closest('li.k-item').hasClass('k-state-active')) {
													$(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").click();
												}

											});
										}, 150);

										this.loadVisibleImages();
									}

								},
								loadVisibleImages: function () {
									var t = setTimeout(function () {
										//$("html, body").animate({ scrollTop: $("#taxonResults").offset().top - 200 }, 600, 'swing');
										//var $images = $("#dkg_panelbar_flex_item .dkg_panelbar>li.k-item.k-state-active>ul>li>span>div>div.dk_image_flex_item>figure>a>img.lazy_dk_image");
										var $images = $("#dkg_panelbar_flex_item .dkg_panelbar>li.k-item.k-state-active img.lazy_dk_image");
										$images.each(function () {
											g_preloadImage($(this)[0]);
											g_setImgCaption($(this)[0]);
										});
									}, 300);
								},
								disableZeroDks: function () {
									var that = this;
									//regular dk panelbar items
									$(this.dk_list_item_selector).map(function () {
										if (typeof ($(this).data('desckeyid')) == "string") {
											if ($(this).data('desckeyid').indexOf(",") != -1) {
												//multiple data-desckeyid for dk-list-item with type = "PIC"
												var dk_arr = $(this).data('desckeyid').split(",");
												dk_arr.forEach(function (item) {
													if (that.dkWhitelist.hasOwnProperty(item)) {
														$(this).closest('li.k-item').removeClass('k-state-disabled');
														$(that.dk_pic_list_item_selector + "[data-desckeyid=" + item + "]").removeClass('k-state-disabled');
													} else {
														$(this).closest('li.k-item').addClass('k-state-disabled');
														$(that.dk_pic_list_item_selector + "[data-desckeyid=" + item + "]").addClass('k-state-disabled');
													}
												})
											}
										} else if (that.dkWhitelist.hasOwnProperty($(this).data('desckeyid'))) {
											$(this).closest('li.k-item').removeClass('k-state-disabled');
										} else {
											$(this).closest('li.k-item').addClass('k-state-disabled');
										}
									});
									//PIC type dk
									$(this.dk_list_item_selector).map(function () {

									});
								},
								onSelect: function (e) {
									console.log("onselect");
									var panelBar = e.sender;
									var qFilter = new QueryFilter();
									var text = panelBar.dataItem($(e.item)).KeyGroupName;

									/** DESCKEY CLICKED */
									if (typeof (panelBar.dataItem($(e.item)).KeyGroupName) == 'undefined') {
										qFilter.DataType = g_getDataTypeByDKGId(panelBar.dataItem($(e.item)).DescriptionKeyGroupId);
										
										let dkId = panelBar.dataItem($(e.item)).DescriptionKeyId;
										if($("span.dk_list_item[data-desckeyid="+dkId+"]").closest("span.k-link").hasClass("state-selected-steady")) {
											$("div.filter_flex_item[data-desckeyid="+dkId+"]").find("a.k-button.k-delete-button").trigger("click");
											return false;
										} else if (qFilter.DataType == "VALUE" || qFilter.DataType == "PIC") {
											e.preventDefault();
											panelBar.dataItem($(e.item)).selected = false;
											$(".k-state-selected", e.item).removeClass("k-state-selected k-state-focused");
											return;
										}
										
										text = panelBar.dataItem($(e.item)).KeyName;

										qFilter.KeyName = text;
										qFilter.DescriptionKeyId = panelBar.dataItem($(e.item)).DescriptionKeyId;
										qFilter.DescriptionKeyGroupId = panelBar.dataItem($(e.item)).DescriptionKeyGroupId;
										qFilter.DescriptionKeyGroupName = g_getKeyGroupNameByDKGId(panelBar.dataItem($(e.item)).DescriptionKeyGroupId);
										qFilter.DataType = g_getDataTypeByDKGId(panelBar.dataItem($(e.item)).DescriptionKeyGroupId);

									} else {
										//collapse
										if ($(e.item).is(".k-state-active")) {
											//window.setTimeout(function () { panelBar.collapse(e.item); }, 1);
										}
										return;
									}

									//this.selectedItems.set(qFilter.DescriptionKeyGroupId, qFilter);
									this.selectedItems[qFilter.DescriptionKeyGroupId + ";" + qFilter.DescriptionKeyId] = qFilter;

									//notify filter list + ajax request
									g_updateAll();

									//jquery hack to deselect all panelheaders after sorting -- TODO: find source of error
									var t = setTimeout(function () {
										$("#dkg_panelbar_flex_item .dkg_panelbar>li.k-item[role='menuitem']>span.k-link").removeClass('k-state-selected');
									}, 200);
								},
								dataBound: function (e) {
								},
								onBind: function () {
									console.log("on bind");
									console.log(this.data);
									this.setSort();
									g_initDetermination();
								}
							});
							kendo.bind($("#dkg_panelbar_flex_item"), viewModel_dkg_pb);
							viewModel_dkg_pb.onBind();
							var sectionLinks = document.querySelectorAll("a.sectionLink");
							sectionLinks.forEach(function (item) {
								item.addEventListener(function (e) {
									e.preventDefault; console.log("stopped it");
								});
							});

							//TODO: test
							$("#dkg_panelbar.k-panelbar").delegate("a.swipeLink, a.swipeLink>img", "click", function (e) {
								console.log("preventing swipelink");
								e.preventDefault();
								e.stopPropagation();
							});

						</script>
						</div>
					</div>
				</div>
				<!--EO RIGHT COL -->
			</div>
    		<!-- EO DETERMINATION KENDO -->
        		</div>
        	</div>
        </div>
    </section> 
</div>
</main>
<?php get_footer();