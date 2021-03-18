<?php /* Template Name: kbs_erkennen_bodentier */ ?>
<?php get_header(); ?>

<main class="page-content">
<header class="entry-header">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
	<link type="text/css" href="<?php echo get_template_directory_uri(); ?>/02_kbs_assets/styles/merkmalsbestimmung_general.css" rel="stylesheet" />
</header>
    <!--style>
    body {
            font-family: 'Oswald', sans-serif;
        }
        .shake {
            animation: shake 0.5s;
            animation-iteration-count: infinite;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }
		h3 {
			text-transform: uppercase;
			margin-top: 2rem;
			margin-bottom: 1rem;
			font-size: 2.4rem;
		}
		h4 {
			text-transform: uppercase;
			margin-bottom: .5rem;
			font-size: 2rem;
		}
	
		.level_container {
			padding: 10px;
		}
		.filter_container {
			display: flex;
    		border: 1px solid #e6e6e6;
    		padding: 15px;
    		justify-content: space-between;
			margin-top: 1rem;
		}
		
		.position_gender_wrap {
			display: flex;
			flex-wrap: wrap;
			margin-top: 1rem;
		}
		.position_gender_wrap > div {
			width: 50%;
			min-width: 320px;
		}
	
        .dk_image_container {
            padding: 5px;
            box-shadow: inset 3px 3px 3px #DDD;
            overflow: auto;
            background: whitesmoke;
            cursor: default;
            padding-left: 15px;
        }

        .badge {
            border-radius: 50%;
            width: 1.6rem;
            height: 1.6rem;
            padding: 0.4rem;
            background: #fff;
            border: 2px solid #666;
            color: #666;
            text-align: center;
            font: 1.4rem Arial, sans-serif;
            float: right;
            margin-right: 5px;
        }

        .datatypePic {
            margin-right: 0;
        }

        .dk_image_container .lazy_dk_image {
            min-height: 100px;
            object-fit: cover;
            height: 150px;
            width: 112.5px;
            vertical-align: middle;
            padding: 3px;
        }

        .k-state-disabled .dk_image_container {
            display: none;
        }

        #taxDropdown_listbox > li.k-state-selected {
            color: inherit;
            background-color: inherit;
            border-color: none;
            box-shadow: none;
        }

        .dk_image_container figure {
            margin: 0;
            height: 150px;
            width: 112.5px;
            min-height: 100px;
            padding: 3px;
            display: inline-flex;
        }

        .determination_wrapper {
            display: flex;
            flex-direction: row-reverse;
            flex-wrap: wrap-reverse;
        }

        .k-link.k-header {
            padding: 10px !important;
        }

        .leftColumn_wrapper, .rightColumn_wrapper {
            display: flex;
            flex-direction: column;
            padding: 10px;
            position: -webkit-sticky;
            /** disabled for local dev **/
            /** position: sticky; **/
            top: 0;
            flex: 1 1 auto;
            min-width: 320px;
        }
		
		figcaption.hidden_caption {
			display: none;
		}

        .leftColumn_wrapper {
            width: 66%;
        }

        .rightColumn_wrapper {
            width: 33%;
        }

        .state-selected-steady {
            background-color: #BEBE00;
        }

        .state-selected-steady-dkg {
            color: #BEBE00 !important;
        }

        .k-state-selected {
            background-color: #BEBE00;
        }

        .state-hidden {
            display: none;
        }
        
        .state-active {
            background-color: #ccc!important;
        }


        .state-selected-steady .dk_list_item {
            color: #fff;
        }

        .dk-filter-heading {
            cursor: pointer;
        }
		
		.delete_container {
			display: flex;
		}
		.delete_container > div {
			margin: auto;
		}

        #dkg_panelbar_container {
            width: 100%;
            position: relative;
        }

        #dkg_panelbar_container > div.demo-section.k-content > div > div > li.k-item > span > div > span,
        #dkg_panelbar_container > div.demo-section.k-content > div > div > li.k-item > span > div > div > span {
            font-size: 1.5rem;
        }

        .dk_value_wrapper {
            padding: 5px 5px 5px 20px;
        }

        .dk_list_item {
            font-size: 1.4rem;
            font-family: "Roboto", Helvetica, Arial, sans-serif;
        }

        .heading_container {
            padding: 5px;
            padding-left: 20px;
            background: rgba(0,0,0,0.02);
        }

        ul[role="group"] > li[role="menuitem"] > span.k-link {
            padding: 0px;
        }
        /*TAXON RESULTS*/
        .taxon_list_header {
    		font-size: 1.6rem;
    		font-weight: 500;
    		padding: 15px;
    		display: flex;
    		justify-content: space-between;
    		flex-wrap: wrap;
		}

        .taxon_details ul {
            margin: 0;
            padding: 10px 20px;
            font-size: 1.4rem;
            font-family: "Roboto", Helvetica, Arial, sans-serif;
        }
        /*LOADING */
        .loading_layer {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            content: "loading";
            background-color: rgba(0,0,0,0.7);
            z-index: 99;
            display: none;
        }

        .lds-roller {
            display: inline-block;
            position: relative;
            width: 64px;
            height: 64px;
            left: calc(50% - 32px);
            top: calc(25% - 32px);
        }

        .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 32px 32px;
        }

        .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #fff;
            margin: -3px 0 0 -3px;
        }

        .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }

        .lds-roller div:nth-child(1):after {
            top: 50px;
            left: 50px;
        }

        .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }

        .lds-roller div:nth-child(2):after {
            top: 54px;
            left: 45px;
        }

        .lds-roller div:nth-child(3) {
            animation-delay: -0.108s;
        }

        .lds-roller div:nth-child(3):after {
            top: 57px;
            left: 39px;
        }

        .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }

        .lds-roller div:nth-child(4):after {
            top: 58px;
            left: 32px;
        }

        .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }

        .lds-roller div:nth-child(5):after {
            top: 57px;
            left: 25px;
        }

        .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }

        .lds-roller div:nth-child(6):after {
            top: 54px;
            left: 19px;
        }

        .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }

        .lds-roller div:nth-child(7):after {
            top: 50px;
            left: 14px;
        }

        .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }

        .lds-roller div:nth-child(8):after {
            top: 45px;
            left: 10px;
        }

        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .viewModel_container {
            padding-bottom: 2em;
        }

        #dkListView div.dk-view.k-widget {
            cursor: pointer;
            padding: 20px 15px;
        }

        #dkFilterListView dl {
            padding: 10px 15px;
        }

        .k-panel > li.k-item {
            border-bottom: 2px solid #E6E6E6;
        }
        /** hack for not showing disabled item selection*/
        div.disabled_select {
            background-color: #fff;
            color: #000;
            border-color: rgb(213,213,213);
        }

        .taxon-view {
            cursor: pointer;
        }

        .taxon_details {
            display: none;
            background-color: rgba(128, 128, 128, 0.2);
        }
        /* Style the tab */
        .tab {
            border: 1px solid #ccc;
        }

        /* Style the buttons that are used to open the tab content */
        .tab > .k-content > .k-listview > .k-widget {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            list-style: none;
        }

        /* Change background color of buttons on hover */
        .tab > .k-content > .k-listview > .k-widget:hover {
            background-color: #ddd;
        }

        button.cat-tooltip:after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 130%;
            left: 15%;
            background: rgb(75,75,75);
            padding: 5px 15px;
            color: white;
            -webkit-border-radius: 10px;
            -moz-border-radius   : 10px;
            border-radius        : 10px;
            white-space: nowrap;
            opacity: 0;
             /* At time of this creation, only Fx4 doing pseduo transitions */
            -webkit-transition: all 0.4s ease;
            -moz-transition   : all 0.4s ease;
			font-size: 1.4rem;
			font-family: "Roboto", Helvetica, Arial, sans-serif;
        }
	    button.cat-tooltip:nth-last-of-type(-n + 4):after {
            bottom: -130%;
        }
        button.cat-tooltip {
            position: relative;
        }
        button.cat-tooltip:before {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-top: 20px solid rgb(75,75,75);
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            /* At time of this creation, only Fx4 doing pseduo transitions */
            -webkit-transition: all 0.4s ease;
            -moz-transition   : all 0.4s ease;
            opacity: 0;
            left: 30%;
            bottom: 90%;
          }
		button.cat-tooltip:nth-last-of-type(-n + 4):before {
			border-bottom: 20px solid rgb(75,75,75);
			border-top: transparent;
		}
	
	    button.cat-tooltip:nth-last-of-type(-n + 4):before {
	        bottom: -90%;
        }
        
        button.cat-tooltip:hover:after {
            bottom: 100%;
        }
        
        button.cat-tooltip:hover:before {
            bottom: 70%;
        }
		
        button.cat-tooltip:nth-last-of-type(-n + 4):hover:after {
			bottom: -70%;
		}
		
        button.cat-tooltip:nth-last-of-type(-n + 4):hover:before {
			bottom: -30%;
		}
        
        button.cat-tooltip:hover:after, button.cat-tooltip:hover:before {
            opacity: 1;
        }

        .k-widget.k-slider {
            min-width: 300px;
            width: 400px;
        }
        /* Create an active/current tablink class */
        .tab > .k-content > .k-listview > .k-widget:active, .tab > .k-content > .k-listview > .k-widget:focus {
            background-color: #bbb;
        }
		
	.steckbrief_btn {
	 	background: rgb(190,190,0);
	}

		
    </style>
	</header--!>
	<!-- RD Parallax-->
	<?php get_template_part('partials/kbs_parallax_header'); ?>

	<div class="entry-content">
    <section class="text-md-left section-80 section-md-110">
        <div class="shell">
			<div class="range">
				<!-- -->
        		<div class="cell-xs-12 cell-md-12 cell-lg-12 text-left">
	<!-- START DETERMINATION -->
    <!-- SWITCH BELOW FOR LOCAL DEVELOPMENT PLEASE-->
    <input type=hidden id="topLevelFilter" value="<?php echo get_field('toplevelfilter'); ?>"/>
	<input type="hidden" id="lowLevelFilter" value="<?php echo get_field('lowlevelfilter'); ?>"/>
	<input type="hidden" id="groupFilter" value="<?php echo get_field('groupfilter'); ?>"/>					
    <!-- input type=hidden id="topLevelFilter" value="Animalia" -->
					
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

        const g_crudServiceBaseUrl = "http://185.15.246.2:8081/api";
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
        });

        /**
         * GLOBALLY USED MODELS & DATASOURCES
         * */
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
            },
            hasChildren: "DescriptionKey",
            children: "DescriptionKey"
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
            sort: { field: "RipValue", dir: "asc" },
            filter: { logic: "or", field: "DescriptionKeyGroupDataType", operator: "isnotnull" }
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

        function g_setImgCaption($imgDom) {
            let imgName = $imgDom.attr('data-src').split(/[/]+/).pop().split(/[.]+/).shift();
            $.ajax({
                cache: false,
                type: "GET",
                url: g_crudServiceBaseUrl + "/images/byname/" + imgName,
                success: function (data) {
                    g_createFigCaptionDom(data, $imgDom);
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
                //create caption domelement and append
                var caption = document.createElement("figcaption");
                caption.setAttribute('class', 'hidden_caption');
                //var content = document.createTextNode("");
                for (var i in dataObj) {
                    //console.log(dataObj);
                    var taxonName = "";
                    if (dataObj[i].TaxonName !== null) {
                        taxonName = "Taxon: " + dataObj[i].TaxonName;
                    }
                    var auth = "Autor: " + dataObj[i].Author;
                    var copText = "";
                    if (dataObj[i].CopyrightText !== null) {
                        copText = "Quelle: " + dataObj[i].CopyrightText;
                    }
					var desc = "";
					if(dataObj[i].Description != null) {
                    	desc = "Beschreibung: " + dataObj[i].Description;
					}
                    var lic = "";
                    if (dataObj[i].LicenseName !== null) {
                        lic = "Lizenz: " + dataObj[i].LicenseName;
                    }
                    var content = document.createTextNode(taxonName + " " + desc + " " + auth + " " + copText);
                }
                if (typeof (content) !== 'undefined') {
                    caption.appendChild(content);
                    $imgDom.closest("figure").append(caption);
                } else {
                    //console.log(typeof (content));
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
                cache: false,
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

        function g_getKeyGroupNameByDKGId(dkgId) {
            if (keyGroup_DataSource_full) {
                if (typeof (keyGroup_DataSource_full.get(dkgId)) !== 'undefined') {
                    return keyGroup_DataSource_full.get(dkgId).get("KeyGroupName");
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

        function g_updateAll(selectedItemsMap = null) {
            //update request
            console.log("g_updateAll");
            if (selectedItemsMap !== null) {
                viewModel_dkg_pb.set("selectedItems", selectedItemsMap);
                console.log(viewModel_dkg_pb.get("selectedItems"));
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
                    //console.log(selItems[f])
                    if (selItems.hasOwnProperty(f) && selItems[f].DataType == "TAXLEVEL") {
                        //set dropdown to taxlevel found in selectedItems
                        console.log("selItems");
                        taxDrop.search(selItems[f].KeyName);
                        return;
                    } else if (selItems.hasOwnProperty(f) && selItems[f].DataType == "GROUPING") {
                        nextFlag = false;
						console.log("selItems");
						console.log(selItems[f]);
                        taxDrop.select(function (dataItem, index) {
                            if (dataItem.TaxonomyStateId == selItems[f].DataValue) {
                                nextFlag = true;
                                return dataItem;
                                //return dataItem;
                            }
                            if (nextFlag) {
                                console.log(dataItem);
                                //return dataItem;
                            }
                        });
                        return;
                    } else {

                    }
                }
            }
        }

        function g_dkg_UpdateAll(filterDkgId) {
            //update filter list
            console.log(filterDkgId);
            console.log(typeof (filterDkgId));
            if (typeof(filterDkgId) === 'string' && filterDkgId.length > 5) {
                filterDkgId = filterDkgId.split(",");
            }
            viewModel_dkg_pb.set("regionFilter", filterDkgId);
            viewModel_dkg_pb.updateFilter();
        }

        function g_dk_FilterRemovedEvent(filterItemsArray) {
            console.log("g_dk_FilterRemovedEvent");
            console.log(filterItemsArray);
            selectedItemsMap = new Object;
            var isLevelFilterSet = false;
            filterItemsArray.forEach(function (item) {
                if (item.DataType == "GROUPING" || item.DataType == "TAXLEVEL") {
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
            g_updateAll(selectedItemsMap);
            //var selectedItemsMap = new Object(filterItemsArray.map(i => [i.DescriptionKeyGroupId+";"+i.DescriptionKeyId] = i));
            //update request
        }

        function g_getTaxDescResult() {
            var selectedItems = viewModel_dkg_pb.get("selectedItems");
            var queryString = "";
            //for loop string creation
            if (selectedItems != null) {
                for (let item in selectedItems) {
                    //console.log(item);
                    //selectedItems.forEach(function (item) {
                    if (selectedItems[item].DataType == "VALUE") {
                        queryString += "&" + "data_value_" + encodeURIComponent(selectedItems[item].DescriptionKeyId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "VALUELIST" || selectedItems[item].DataType == "YESNO" || selectedItems[item].DataType == "OPEN VAL" || selectedItems[item].DataType == "UNKNOWN" || selectedItems[item].DataType == "PIC") {
                        //valuelist, yesno, orderFilter, ...
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
                        //TODO: check if Grouping can be handled same way as VALUELIST, ..
                    } else if (selectedItems[item].DataType == "GROUPING") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
                    } else if (selectedItems[item].DataType == "TAXLEVEL") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DescriptionKeyId);
                    } else if (selectedItems[item].DataType == "TLF") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "LLF") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "GGF") {
                        console.log("GGF query");
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "GENDER") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue);
                    } else if (selectedItems[item].DataType == "POSITION") {
                        queryString += "&" + encodeURIComponent(selectedItems[item].DescriptionKeyGroupId) + "=" + encodeURIComponent(selectedItems[item].DataValue.join(","));
                    }
                };
            }
            console.log(queryString);

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
                                console.log("pues nada");
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
                    console.log("Fehler:" + exception);
                },
                complete: function () {
                    g_enableInput(g_none_left);
                }
            });
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
        });
    </script>

    <!-- Level Dropdown -->
	<div class="level_wrap" style="display:none;">
		    <div class="level_container">
        <h4>Was möchten Sie bestimmen?</h4>
        <div id="taxDropdown" style="width: 300px;">
            <div class="dkg-section k-content">
                <input id="taxLevel"
                       data-role="dropdownlist"
                       data-bind="source: dataSource,
                              visible: isVisible" />
            </div>				
	</div>

            <script id="tax_dropdown_template" type="text/x-kendo-template">
                #if(TaxonomyStateId != -1) {#
                <span>
                    Nach #: TaxonName # filtern
                </span>
                #}else{#
                <span>
                    #: TaxonName #
                </span>
                #}#
            </script>
            <script>

                //TODO: move to viewModel
                function g_onTaxDropSelect(e) {
                    //console.log(e);
                    if(taxDrop.isVisible) {
						var t = setTimeout(function () {
                        var dataItem = taxDrop.dataItem();
                        if (dataItem.StateId == null) {
                            e.preventDefault();
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
                                //console.log(viewModel_dkg_pb.get("selectedItems"));
                            } else {
                                //taxlevel filter set to all --> remove from queryList
                                for (var f in selItems) {
                                    if (selItems.hasOwnProperty(f) && selItems[f].DataType == "TAXLEVEL") {
                                        delete selItems[f];
                                    }
                                }
                            }
                            console.log("g_onTaxDropSelect");
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
					}
                };

                $("#taxDropdown").kendoDropDownList({
                    dataTextField: "TaxonName",
                    initBound: false,
					isVisible: false,
                    itemSelectorStr: "#taxDropdown_listbox > li.k-item",
                    //filter: "startswith",
                    dataValueField: "TaxonomyStateId",
                    template: kendo.template($("#tax_dropdown_template").html()),
                    dataSource: {
                        transport: {
                            read: {
                                dataType: "json",
                                url: g_crudServiceBaseUrl + "/taxonDescriptions/levels/?toplevel=" + encodeURIComponent(g_topLevelFilter) + "&lowLevel=" + encodeURIComponent(g_lowLevelFilter) + "&groupFilter=" + encodeURIComponent(g_groupFilter),
                            }
                        },
                    },
                    setSearch: function () {
                        this.search("Arten");
                    },
                    select: function (e) {
						if(this.isVisible) {
							//e.preventDefault();
							var selItems = viewModel_dkg_pb.get("selectedItems");
								//every selection in dropdown first deletes the GROUPING filter
								g_removeDataTypeFromSelection("GROUPING");
								for (var f in selItems) {
									if (selItems.hasOwnProperty(f) && selItems[f].DataType != "TLF" && selItems[f].DataType != "LLF" && selItems[f].DataType != "GGF") {
										delete selItems[f];
									}
								}
							var taxonId = e.dataItem.TaxonId;
							var taxonName = e.dataItem.TaxonName;
							var taxonomyStateId = e.dataItem.TaxonomyStateId;
							if (taxonId && taxonName && taxonomyStateId) {
								g_filterByGroup(taxonId, taxonName, taxonomyStateId);
							} else {
								console.log("Error getting filter group data");
							}
						}
                    },
                    tax_filterByGroup: function (e) {
                    },
                    //below replaced by tax_filterByGroup
                    //select: g_onTaxDropSelect,
                    dataBound: function () {
                        if (!this.initBound) {
                            var that = this;
                            var dataSource = this.dataSource;
                            var data = dataSource.data();
                            if (!this._adding) {
                                this._adding = true;
                                that.select(0);
                                
                                //that.trigger("select", dataItem);
                                /**
                                that.trigger("select",
                                    { dataItem: dataItem }
                                );
                                **/
                                /**
                                var t = setTimeout(function () {
                                    //
                                    that.search(dataItem.TaxonName);
                                }, 150);
                                 */

                                //$(this.itemSelectorStr).removeClass('k-state-selected');
                                //var dataItem = taxDrop.dataItem();
                                //console.log(dataItem);
                                //g_onTaxDropSelect(dataItem);
                            }
                            this.initBound = true;
                        }
                    }
                });
                var taxDrop = $("#taxDropdown").data("kendoDropDownList");
            </script>
        </div>
    </div>

    <div class="determination_wrapper">
        <!-- TABSTRIP -->
        <div class="leftColumn_wrapper">
            <h3>Merkmalsfilter</h3>
            <!-- TabStrip -->
            <h4>Region</h4>
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
                            }, 300);
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

            <!-- Lage -->
            <h4>Lage</h4>
            <div id="positionDropdown">
                <div class="dkg-section k-content">
                    <input id="positionLevel"
                           data-role="dropdownlist"
                           data-text-field="KeyGroupName"
                           data-value-field="DescriptionKeyGroupId"
                           data-bind="source: dataSource,
                              visible: isVisible" />
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

            <!-- M/W -->
			<div style="display:none;">
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
						isVisible: false,
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
                                var dataSource = this.dataSource;
                                var data = dataSource.data();
								data.forEach(function (it, ix) {
                                    if (it.DescriptionKeyTypeName.indexOf(";") > -1) {
                                        it.DescriptionKeyTypeName = it.DescriptionKeyTypeName.replace(";", " &");
                                    }
                                });

                                if (!this._adding) {
                                    this._adding = true;
                                    data.splice(0, 0, {
                                        "DescriptionKeyTypeId": -1,
                                        "DescriptionKeyTypeName": "Keine Auswahl",
                                    });

                                    this._adding = false;
                                    this.select(0);
                                }
                                this.initBound = true;
                            }
                        }
                    });
                    var genderDrop = $("#genderDropdown").data("kendoDropDownList");

                    function g_onGenderSelect(e) {
                        if (typeof (e.dataItem) !== 'undefined') {
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
                            viewModel_dkg_pb.updateFilter();
                        }
                    }

                </script>
            </div>

            <!-- PANELBAR -->
            <h4 id="desckey_h4_header">Merkmalsabfrage</h4>
            <div id="dkg_panelbar_container">
                <div class="loading_layer"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>
                <div class="demo-section k-content">
                    <div>
                        <div id="dkg_panelbar"
							 class="dkg_panelbar"
                             data-role="panelbar"
                             data-load-on-demand="false"
                             data-text-field="KeyGroupName"
                             data-expand-mode="multiple"
                             data-template="panelbar_detail_template"
                             data-bind="visible: isVisible,
										source: data,
										events: { select: onSelect,
												expand: onExpand,
												bind: onBind
										}">
                        </div>
                    </div>
                </div>

                <script id="panelbar_detail_template" type="text/kendo-ui-template">
                    <div>

                        # if (item.DescriptionKey) { #
                        <!-- KeyGroup-Level -->
                        <span data-desckeygroupid="#: item.DescriptionKeyGroupId #"> #: item.KeyGroupName # </span>
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
                                    <input data-role="slider"
                                           data-min="#= g_getSliderValue(item.DescriptionKeyId, false)#"
                                           data-max="#= g_getSliderValue(item.DescriptionKeyId, true)#"
										   data-step="1"
                                           data-small-step="1"
                                           data-large-step="10"
                                           data-show-buttons="false"
                                           data-desckeyid="#= kendo.toString(item.DescriptionKeyId) #"
                                           data-desckeygroupid="#= kendo.toString(item.DescriptionKeyGroupId) #"
                                           data-desckeyname="#= kendo.toString(item.KeyName) #"
                                           data-bind="visible: isVisible,
								            enabled: isEnabled,
								            value: selectedNumber,
								            events: { change: onChangeDkValue }" />
                                </div>
                            </div>
                        </div>
                        # } else if(dkType === "PIC") {#
                        <!-- PIC -->
                        <div class="heading_container">
                            <span class="dk_list_item" data-desckeyid="#: item.DescriptionKeyId #">#: item.KeyName #</span>
                            <span class="badge">0</span>
                        </div>
                        # } else { #
                        <!-- VALUELIST -->
                        <div class="heading_container">
                            <span class="dk_list_item" data-desckeyid="#: item.DescriptionKeyId #">#: item.KeyName #</span>
                            <span class="badge">0</span>
                        </div>
                        # } #
                        # if(item.ListSourceJson != null) { #
                            # var objList = JSON.parse(item.ListSourceJson); #
                            # if(objList != null) { #
                                <div class="dk_image_container">
                                # for (var i = 0; i < objList.length; i++) { #
                                # var sourceStr = g_imagePath+objList[i].trim()+".jpg"; #
                                # var widthStr = "calc("+parseFloat(100/objList.length)+"% - 10px);"; #
                                    <figure>
                                        <a class="swipeLink" href="#=sourceStr#">
                                            <img onclick="initPhotoSwipeFromDOM('.dk_image_container');" onload="g_setDataAttributes($(this))" onerror="this.src='https://via.placeholder.com/112x150.jpg?text=Bild+wird+nachgereicht'" class="lazy_dk_image" data-src="#=sourceStr#" alt="#=objList[i]#">
                                        </a>
                                    </figure>
                                # } #
                                </div>
                            #}#
                        # } #
                        # } else { #
                        no description key id
                        # } #

                        # } #
                    </div>
                </script>
                <script>

                    var viewModel_dkg_pb = kendo.observable({
                        isVisible: true,
                        data: keyGroup_DataSource_full,
                        //selectedItems = Map if radio-type selection, Array if checkbox-like
                        selectedItems: new Object(),
                        //will be set through dropdowns (Merkmalsfilter)
                        regionFilter: null,
                        positionFilter: null,
                        genderFilter: null,
                        queryTaxLevel: null,
                        sliderVals: null,
                        selectedDKG: null,
                        dkWhitelist: null,
                        badgesList: null,
                        ripOrder: null,
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
                            if (this.genderFilter != null) {
                                var fil = this.addDKGTypeIdFilter(this.genderFilter);
                                _flt.filters.push(fil);
                            } else {
                                _flt.filters.push({ field: "DescriptionKeyGroupDataType", operator: "isnotnull" });
                            }
                            if (_flt.filters[0] == null) {
                                _flt = { logic: "and", filters: [] };
                                _flt.filters.push({ field: "DescriptionKeyGroupDataType", operator: "isnotnull" });
                            }
                            //always push original filter additionaly
                            _flt.filters.push({ field: "RipValue", operator: "isnotnull" });
                            _fltMain.push(_flt);
                            this.data.query({ filter: _fltMain });
                            this.data.sort({ field: "RipValue", dir: "asc" });
                            this.loadVisibleImages();
                            this.updateAllInfo();
                        },
                        showDkg: function (dkg) {
                            var $targetDkg = $(this.dkg_list_item_selector + "[data-desckeygroupid='" + dkg + "']");
                            if (!$targetDkg.closest('li.k-item').hasClass('k-state-active')) {
                                $targetDkg.click();
                            }
                            $("html, body").animate({ scrollTop: $targetDkg.offset().top - 100 }, 600, 'swing');
                        },
                        onChangeDkValue: function (e) {
                            //clearTimeout(t);
                            if (this.busyUpdating === false) {
                                var that = this;
                                var $item = e.sender.element;
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
                                    qFilter.DataValue = e.value;
                                    viewModel_dkg_pb.selectedItems[qFilter.DescriptionKeyGroupId + ";" + qFilter.DescriptionKeyId] = qFilter;
                                    //notify filter list + ajax request
                                    g_updateAll();
                                    that.busyUpdating = false;
                                    $item.closest('.k-slider').removeClass('k-state-disabled');
                                }, 600);
                            }
                        },
                        dkg_list_item_selector: "#dkg_panelbar_container > div.k-content > div > div > li.k-item > span > div > span",
                        dk_list_item_selector: "#dkg_panelbar_container .dkg_panelbar>li.k-item>ul.k-group>li.k-item span.dk_list_item",
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
                                $("#dkg_panelbar_container .dkg_panelbar>li.k-item[role='menuitem'] .k-state-selected").removeClass('k-state-selected');
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
                            if (this.badgesList) {
                                //var dk_list_item_selector = "#dkg_panelbar_container .dkg_panelbar>li.k-item>ul.k-group>li.k-item span.dk_list_item";
                                this.badgesList.forEach(function (key, val) {
                                    $(that.dk_list_item_selector + "[data-desckeyid=" + val + "]").siblings('.badge').text(key);
                                    $(that.dk_list_item_selector + "[data-desckeyid=" + val + "]").siblings('.datatypePic').find('.badge').text(key);
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
                                        if (selItem.DataType !== 'GROUPING' && selItem.DataType !== 'TAXLEVEL' && selItem.DataType !== 'TLF'&& selItem.DataType !== 'LLF' && selItem.DataType !== 'GGF' && selItem.DataType !== 'POSITION' && selItem.DataType !== 'GENDER') {
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

                                this.data.query({ filter: _flt });
                                this.data.sort({ field: "RipValue", dir: "asc" });
                                //disable description key dom elements

                                //iterate all doms - set all active and get desckeyids
                                $(that.dk_list_item_selector).map(function () {
                                    if (that.dkWhitelist.hasOwnProperty($(this).data('desckeyid'))) {
                                        $(this).closest('li.k-item').removeClass('k-state-disabled');
                                    } else {
                                        $(this).closest('li.k-item').addClass('k-state-disabled');
                                    }
                                    return $(this).data('desckeyid');
                                });

                                this.disableZeroDks();

                                //hack to deselect all clicked panel items and only show selected ones -- TODO: find source of error
                                var t = setTimeout(function () {
                                    $("#dkg_panelbar_container .dkg_panelbar>li.k-item[role='menuitem'] .k-state-selected").removeClass('k-state-selected');
                                    that.selectedItems.forEach(function (item) {
                                        if (item.DataType !== 'VALUE') {
                                            $(that.dk_list_item_selector + "[data-desckeyid='" + item.DescriptionKeyId + "']").closest("span.k-link").addClass('state-selected-steady');
                                        }
                                        $(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").closest("span.k-link").addClass('state-selected-steady-dkg').removeClass('k-state-active');
                                        if ($(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").closest('li.k-item').hasClass('k-state-active')) { $(that.dkg_list_item_selector + "[data-desckeygroupid='" + item.DescriptionKeyGroupId + "']").click(); }

                                    });

                                }, 100);

                                this.loadVisibleImages();

                            }

                        },
                        loadVisibleImages: function () {
                            var t = setTimeout(function () {
                                $("html, body").animate({ scrollTop: $(".leftColumn_wrapper").offset().top - 200 }, 600, 'swing');
                                var $images = $("#dkg_panelbar_container .dkg_panelbar>li.k-item.k-state-active>ul>li>span>div>div.dk_image_container>figure>a>img.lazy_dk_image");
                                $images.each(function () {
                                    g_preloadImage($(this)[0]);
                                });
                            }, 300);
                        },
                        disableZeroDks: function () {
                            var that = this;
                            $(this.dk_list_item_selector).map(function () {
                                if (that.dkWhitelist.hasOwnProperty($(this).data('desckeyid'))) {
                                    $(this).closest('li.k-item').removeClass('k-state-disabled');
                                } else {
                                    $(this).closest('li.k-item').addClass('k-state-disabled');
                                }
                                return $(this).data('desckeyid');
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

                                //VALUE handled by input change event in onChangeDkValue
                                if (qFilter.DataType == "VALUE" || qFilter.DataType == "PIC") {
									console.log("preventing default!!");
									console.log(qFilter.DataType);
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
                                $("#dkg_panelbar_container .dkg_panelbar>li.k-item[role='menuitem']>span.k-link").removeClass('k-state-selected');
                            }, 200);
                        },
                        onBind: function () {
                            g_initDetermination();
                        }
                    });

                    kendo.bind($("#dkg_panelbar_container"), viewModel_dkg_pb);
                    viewModel_dkg_pb.onBind();
                </script>
            </div>
        </div>

    <div class="rightColumn_wrapper">
        <!-- RESULT -->
        <div id="taxonResults" class="viewModel_container">
            <div class="demo-section k-content wide">
                <div>
                    <h4>Taxon</h4>
                    <div data-role="listview"
                         data-template="taxon_detail_template"
                         data-bind="source: taxons_DataSource,
										visible: isVisible,
										events: {
										  change: onChange,
										  dataBound: taxons_DataSourceBound
										}"
                         style="min-height: 30vh; max-height: 45vh; overflow: auto"></div>
                </div>
                <div data-template="taxon_total_template" data-bind="visible: isVisible, source:this" style="padding-top: 1em;">
                </div>
            </div>

            <script type="text/x-kendo-tmpl" id="taxon_total_template">
                #if(total > 0) { #
                <p><b>Gesamt: <span data-bind="text: total"></span></b></p>
                # } else { #
                <p><em>Kein Ergebnis. Bitte 'Gewählte Merkmale' oder 'Taxonomische Ebene' prüfen.</em></p>
                # } #
            </script>

            <script type="text/x-kendo-tmpl" id="taxon_detail_template">
                <div class="taxon-view k-widget">
                    <div class="taxon_list_header" data-target="taxon_details_#:TaxonId#">
                        <div class="taxon_name_wrap">
                            <p>
                                <em>#: TaxonName #</em>
                                #if(TaxonDescription){#&nbsp;#if(HasBracketDescription){##:TaxonDescription ##}else{##:TaxonDescription##}##}#
                            </p>
                        </div>
                        <!-- TEST TBD-->
                        # if(HasTaxDescChildren && taxDrop.isVisible) {#
                        <div class="taxon_seeAll_wrap">
                            <i class="fa fa-filter fa-lg seeAllSpeciesButton" aria-hidden="true" onClick="g_filterByGroup(#:TaxonId#, '#=TaxonName#', #=TaxonomyStateId#)" id="seeAll_#:TaxonId#" data-taxonid="#:TaxonId#" data-target="Nach #:TaxonName# filtern" title="Nach #:TaxonName# filtern"></i>
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
                            <button onclick="g_openTaxonDetails('#:TaxonName#')" class="btn steckbrief_btn" data-target="#:TaxonId#">
                                <span class="taxonDetails_long">zum Steckbrief #:TaxonName#</span>
                                <span class="taxonDetails_short"><i class="fa fa-bug fa-lg" aria-hidden="true" title="Steckbrief #:TaxonName#"></i></span>
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
								type: 'POST',
								url: "/wp-admin/admin-ajax.php",
								data: {
									'action': 'search_page_by_title',
									'data': taxName
								},
								success: function(response) {
									console.log(response);
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
                        console.log("initBound: " + this.initBound);
                        if (!this.initBound) {
                            console.log("initbinding taxonsdatasource");
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

        <!-- FILTER LIST -->
        <h4>Gewählte Merkmale</h4>
        <div id="dkFilterListView" class="viewModel_container">
            <div data-bind="source: queryFilters_DataSource, visible: isVisible" data-template="filter-detail-template">
            </div>
        </div>
        <script type="text/x-kendo-tmpl" id="filter-detail-template">
            # if(typeof(isHidden) !== 'undefined') { #
            # if(!isHidden) { #
            <div class="filter_container">
                #if(typeof(DataType) !== 'undefined') {#
                # if(DataType == "VALUE") {#
                <div class="filter_info_container">
                    <div onClick="g_showDkgInFilterlist(#:DescriptionKeyGroupId#)" class="dk-filter-heading"><b>#: KeyName #:</b></div>
                    <div>#: DataValue # </div>
                </div>
                <div class="delete_container">
                    <div><a data-bind="events {click: remove}" class="k-button k-delete-button"><span class="k-icon k-i-delete"></span></a></div>
                </div>
                #} else if(DataType == "GROUPING") {#
                <div class="filter_info_container">
                    <div class="dk-filter-heading"><b>#: DescriptionKeyGroupName #:</b></div>
                    <div>#: KeyName # </div>
                </div>
                <div class="delete_container">
                    <div><a data-bind="events {click: remove}" class="k-button k-delete-button"><span class="k-icon k-i-delete"></span></a></div>
                </div>
                #} else if(DataType == "TAXLEVEL") {#
                <div class="filter_info_container">
                    <div class="dk-filter-heading"><b>#: DescriptionKeyGroupName #:</b></div>
                    <div>#: KeyName # </div>
                </div>
                <!--dd><a data-bind="events {click: remove}" class="k-button k-delete-button"><span-- class="k-icon k-i-delete"></span></a></dd-->
                #} else {#
                <div class="filter_info_container">
                    <div class="dk-filter-heading" onClick="g_showDkgInFilterlist(#:DescriptionKeyGroupId#)"><b>#: DescriptionKeyGroupName #:</b></div>
                    <div>#: KeyName # </div>
                </div>
                <div class="delete_container">
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
                    console.log("trying to delete");
                    if (e.data.isDeletable) {
                        this.queryFilters_DataSource.remove(e.data);
                        console.log(this.get("queryFilters_DataSource"));
                        console.log(e.data);
                        g_dk_FilterRemovedEvent(this.get("queryFilters_DataSource"));
                    } else {
                        console.log("non-deletable item:");
                        console.log(e);
                    }
                }
            });

            kendo.bind($("#dkFilterListView"), viewModel_queryFilters);

        </script>
        <script>

            $("#dkg_panelbar.k-panelbar").delegate("a.swipeLink", "click", function (e) {
                console.log("preventing default");
				e.preventDefault();
                e.stopPropagation();
            });

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

                        figureEl = thumbElements[i]; // <figure> element

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
                        console.log(clickedGallery);
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
					if(taxDrop.isVisible) {
                    	var index = taxDrop.selectedIndex;
                    	if (taxDrop.options.optionLabel && index > 0) {
                        	index = index - 1;
                    	}
                    	var dataItem = taxDrop.dataItem(index);
                    	var orderQF = g_createOrderFilterQuery(dataItem.TaxonId, dataItem.TaxonName, dataItem.TaxonomyStateId);
                    	console.log(dataItem);
                    	viewModel_dkg_pb.selectedItems[orderQF.DescriptionKeyGroupId + ";" + orderQF.DescriptionKeyGroupId] = orderQF;
                    	console.log(viewModel_dkg_pb.get("selectedItems"));
                    	viewModel_queryFilters.updateFilterList(viewModel_dkg_pb.get("selectedItems"))
                	}
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

        </script>
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