<?php
$this->h2bookmarks = array();
$this->h2toc = array();
$this->decimal_align = array('DP'=>'.', 'DC'=>',', 'DM'=>"\xc2\xb7", 'DA'=>"\xd9\xab", 'DD'=>'-');
$this->mirrorMargins = 0;
$this->restoreBlockPagebreaks = false;
$this->forcePortraitMargins = false;
$this->displayDefaultOrientation = false;
$this->printers_info = false;
$this->bleedMargin = 5;
$this->crossMarkMargin = 5;		// Distance of cross mark from margin in mm
$this->cropMarkMargin = 8;		// Distance of crop mark from margin in mm
$this->cropMarkLength = 18;		// Default length in mm of crop line
$this->nonPrintMargin = 8;		// Non-printable border at edge of paper sheet in mm
$this->margBuffer = 2;			// Allows an (empty) end of block to extend beyond the bottom margin by this amount (mm)
$this->pagenumPrefix;
$this->pagenumSuffix;
$this->nbpgPrefix;
$this->nbpgSuffix;
$this->maxTTFFilesize = 2000;
$this->percentSubset = 30;
$this->useAdobeCJK = false;		// Uses Adobe CJK fonts for CJK languages
$this->repackageTTF = false; 
$this->allow_charset_conversion = true;
$this->biDirectional=false;			// automatically determine BIDI text in LTR page
$this->autoFontGroupSize = 2;			// 1: individual words are spanned; 2: words+; 3: as big chunks as possible.
$this->useLang = true;				// Default changed in mPDF 4.0
$this->useSubstitutions = false;		// Substitute missing characters in UTF-8(multibyte) documents - from other fonts
$this->falseBoldWeight = 5;			// Weight for bold text when using an artificial (outline) bold; value 0 (off) - 10 (rec. max)
$this->allow_output_buffering = false;
$this->enableImports = false;			// Adding mPDFI functions
$this->collapseBlockMargins = true; 	// Allows top and bottom margins to collapse between block elements
$this->progressBar = 0;				// Shows progress-bars whilst generating file 0 off, 1 simple, 2 advanced
$this->progbar_heading = 'mPDF file progress';
$this->progbar_altHTML = '';			// Should include <html> and <body> but NOT end tags
$this->dpi = 96;					// To interpret "px" pixel values in HTML/CSS (see img_dpi below)
$this->allow_html_optional_endtags = true;
$this->ignore_invalid_utf8 = false;
$this->text_input_as_HTML = false; 		// Converts all entities in Text inputs to UTF-8 before encoding
$this->useGraphs = false;
$this->incrementFPR1 = 10;	// i.e. will alter by 1/[10]th of width and try again until within closer limits
$this->incrementFPR2 = 20;
$this->incrementFPR3 = 30;
$this->incrementFPR4 = 50;	// i.e. will alter by 1/[50]th of width and try again when it nearly fits
$this->restrictColorSpace = 0;
$this->PDFX = false;				// true=Forces compliance with PDFX-1a spec
$this->PDFXauto = false;			// Overrides warnings making changes when possible to force PDFX1-a compliance
$this->PDFA = false;				// true=Forces compliance with PDFA-1b spec
$this->PDFAauto = false;			// Overrides warnings making changes when possible to force PDFA1-b compliance
$this->ICCProfile = '';				// Colour profile OutputIntent
$this->showStats = false;
$this->debug = false;
$this->debugfonts = false;	// Checks and reports on errors when parsing TTF files - adds significantly to processing time
$this->showImageErrors = false;
$this->table_error_report = false;		// Die and report error if table is too wide to contain whole words
$this->table_error_report_param = '';	// Parameter which can be passed to show in error report i.e. chapter number being processed//
$this->title2annots = false;
$this->annotSize = 0.5;		// default mm for Adobe annotations - nominal
$this->annotMargin;		// default position for Annotations
$this->annotOpacity = 0.5;	// default opacity for Annotations
$this->anchor2Bookmark = 0;	// makes <a name=""> into a bookmark as well as internal link target; 1 = just name; 2 = name (p.34)
$this->bookmarkStyles = array(
	0 => array('color'=> array(0,64,128), 'style'=>'B'),
	1 => array('color'=> array(128,0,0), 'style'=>''),
	2 => array('color'=> array(0,128,0), 'style'=>'I'),
);
$this->bookmarkStyles = array();
$this->CSSselectMedia='print';		// screen, print, or any other CSS @media type (not "all")
$this->forcePortraitHeaders = false;
$this->defaultheaderfontsize = 8;	// pt
$this->defaultheaderfontstyle = 'BI';	// '', or 'B' or 'I' or 'BI'
$this->defaultheaderline = 1;		// 1 or 0 - line under the header
$this->defaultfooterfontsize = 8;	// pt
$this->defaultfooterfontstyle = 'BI';	// '', or 'B' or 'I' or 'BI'
$this->defaultfooterline = 1;		// 1 or 0 - line over the footer
$this->header_line_spacing = 0.25;	// spacing between bottom of header and line (if present) - function of fontsize
$this->footer_line_spacing = 0.25;	// spacing between bottom of header and line (if present) - function of fontsize
$this->setAutoTopMargin = false;	
$this->setAutoBottomMargin = false;	
$this->autoMarginPadding = 2;		// distance in mm used as padding if 'stretch' mode is used
$this->simpleTables = false; // Forces all cells to have same border, background etc. Improves performance
$this->packTableData = false; // Reduce memory usage processing tables (but with increased processing time)
$this->cacheTables = false;
$this->ignore_table_percents = false;
$this->ignore_table_widths = false;
$this->keep_table_proportions = false;	// If table width set > page width, force resizing but keep relative sizes
$this->shrink_tables_to_fit = 1.4;	// automatically reduce fontsize in table if words would have to split ( not in CJK)
$this->tableMinSizePriority = false;	// If page-break-inside:avoid but cannot fit on full page without 
$this->use_kwt = false;				// "Keep-with-table"
$this->iterationCounter = false;		// Set to TRUE to use table Head iteration counter
$this->splitTableBorderWidth = 0;		// Use table border (using this width in mm) when table breaks across pages
$this->img_dpi = 96;	// Default dpi to output images if size not defined
$this->useKerning = false;	// true to use kerning
$this->justifyB4br = false;	// In justified text, <BR> does not cause the preceding text to be justified in browsers
$this->tabSpaces = 8;	// Number of spaces to replace for a TAB in <pre> sections
$this->jSWord = 0.4;	// Proportion (/1) of space (when justifying margins) to allocate to Word vs. Character
$this->jSmaxChar = 2;	// Maximum spacing to allocate to character spacing. (0 = no maximum)
$this->jSmaxCharLast = 1;	// Maximum character spacing allowed (carried over) when finishing a last line
$this->jSmaxWordLast = 2;	// Maximum word spacing allowed (carried over) when finishing a last line
$this->normalLineheight = 1.33;	// Value used for line-height when CSS specified as 'normal' (default)
$this->smCapsScale = 0.75;	// Factor of 1 to scale capital letters
$this->smCapsStretch = 110;	// % to stretch small caps horizontally (i.e. 100 = no stretch)
$this->allowCJKorphans = true;	// FALSE=always wrap to next line; TRUE=squeeze or overflow
$this->allowCJKoverflow = false;	// FALSE=squeeze; TRUE=overflow (only some characters, and disabled in tables)
$this->CJKforceend = false;		// Forces overflowng punctuation to hang outside right margin mPDF 5.6.40
$this->SHYlang = "en"; // Should be one of: 'en','de','es','fi','fr','it','nl','pl','ru','sv'
$this->SHYleftmin = 2;
$this->SHYrightmin = 2;
$this->SHYcharmin = 2;
$this->SHYcharmax = 10;
$this->keepColumns = false;	// Set to go to the second column only when the first is full of text etc.
$this->max_colH_correction = 1.15;	// Maximum ratio to adjust column height when justifying - too large a value can give ugly results
$this->ColGap=5;
$this->list_align_style = 'R';	// Determines alignment of numbers in numbered lists
$this->list_indent_first_level = 0;	// 1/0 yex/no to indent first level of list
$this->list_number_suffix = '.';	// Content to follow a numbered list marker e.g. '.' gives 1. or IV.; ')' gives 1) or a)
$this->useActiveForms = false;
$this->watermarkImgBehind = false;
$this->showWatermarkText = 0;
$this->showWatermarkImage = 0;
$this->watermarkText = '';
$this->watermarkImage = '';
$this->watermark_font = '';
$this->watermarkTextAlpha = 0.2;
$this->watermarkImageAlpha = 0.2;
$this->watermarkImgAlphaBlend = 'Normal';
$this->autoPadding = false; // Automatically increases padding in block elements when border-radius set - if required
$this->defaultCSS = array(
	'BODY' => array(
		'FONT-FAMILY' => 'serif',
		'FONT-SIZE' => '11pt',
		'TEXT-INDENT' => '0pt',
		'LINE-HEIGHT' => 'normal',
		'MARGIN-COLLAPSE' => 'collapse', /* Custom property to collapse top/bottom margins at top/bottom of page - ignored in tables/lists */
		'HYPHENS' => 'manual',	/* mPDF 5.6.08 */
	),
	'P' => array(
		'MARGIN' => '1.12em 0',
	),
	'H1' => array(
		'FONT-SIZE' => '2em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.67em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H2' => array(
		'FONT-SIZE' => '1.5em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.75em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H3' => array(
		'FONT-SIZE' => '1.17em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '0.83em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H4' => array(
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.12em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H5' => array(
		'FONT-SIZE' => '0.83em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.5em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'H6' => array(
		'FONT-SIZE' => '0.75em',
		'FONT-WEIGHT' => 'bold',
		'MARGIN' => '1.67em 0',
		'PAGE-BREAK-AFTER' => 'avoid',
	),
	'HR' => array(
		'COLOR' => '#888888',
		'TEXT-ALIGN' => 'center',
		'WIDTH' => '100%',
		'HEIGHT' => '0.2mm',
		'MARGIN-TOP' => '0.83em',
		'MARGIN-BOTTOM' => '0.83em',
	),
	'PRE' => array(
		'MARGIN' => '0.83em 0',
		'FONT-FAMILY' => 'monospace',
	),
	'S' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'STRIKE' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'DEL' => array(
		'TEXT-DECORATION' => 'line-through',
	),
	'SUB' => array(
		'VERTICAL-ALIGN' => 'sub',
		'FONT-SIZE' => '55%',	/* Recommended 0.83em */
	),
	'SUP' => array(
		'VERTICAL-ALIGN' => 'super',
		'FONT-SIZE' => '55%',	/* Recommended 0.83em */
	),
	'U' => array(
		'TEXT-DECORATION' => 'underline',
	),
	'INS' => array(
		'TEXT-DECORATION' => 'underline',
	),
	'B' => array(
		'FONT-WEIGHT' => 'bold',
	),
	'STRONG' => array(
		'FONT-WEIGHT' => 'bold',
	),
	'I' => array(
		'FONT-STYLE' => 'italic',
	),
	'CITE' => array(
		'FONT-STYLE' => 'italic',
	),
	'Q' => array(
		'FONT-STYLE' => 'italic',
	),
	'EM' => array(
		'FONT-STYLE' => 'italic',
	),
	'VAR' => array(
		'FONT-STYLE' => 'italic',
	),
	'SAMP' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'CODE' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'KBD' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'TT' => array(
		'FONT-FAMILY' => 'monospace',
	),
	'SMALL' => array(
		'FONT-SIZE' => '83%',
	),
	'BIG' => array(
		'FONT-SIZE' => '117%',
	),
	'ACRONYM' => array(
		'FONT-SIZE' => '77%',
		'FONT-WEIGHT' => 'bold',
	),
	'ADDRESS' => array(
		'FONT-STYLE' => 'italic',
	),
	'BLOCKQUOTE' => array(
		'MARGIN-LEFT' => '40px',
		'MARGIN-RIGHT' => '40px',
		'MARGIN-TOP' => '1.12em',
		'MARGIN-BOTTOM' => '1.12em',
	),
	'A' => array(
		'COLOR' => '#0000FF',
		'TEXT-DECORATION' => 'underline',
	),
	'UL' => array(
		'MARGIN' => '0.83em 0',		/* only applied to top-level of nested lists */
		'TEXT-INDENT' => '1.3em',	/* Custom effect - list indent */
	),
	'OL' => array(
		'MARGIN' => '0.83em 0',		/* only applied to top-level of nested lists */
		'TEXT-INDENT' => '1.3em',	/* Custom effect - list indent */
	),
	'DL' => array(
		'MARGIN' => '1.67em 0',
	),
	'DT' => array(
	),
	'DD' => array(
		'PADDING-LEFT' => '40px',
	),
	'TABLE' => array(
		'MARGIN' => '0',
		'BORDER-COLLAPSE' => 'separate',
		'BORDER-SPACING' => '2px',
		'EMPTY-CELLS' => 'show',
		'LINE-HEIGHT' => '1.2',
		'VERTICAL-ALIGN' => 'middle',
	),
	'THEAD' => array(
	),
	'TFOOT' => array(
	),
	'TH' => array(
		'FONT-WEIGHT' => 'bold',
		'TEXT-ALIGN' => 'center',
		'PADDING-LEFT' => '0.1em',
		'PADDING-RIGHT' => '0.1em',
		'PADDING-TOP' => '0.1em',
		'PADDING-BOTTOM' => '0.1em',
	),
	'TD' => array(
		'PADDING-LEFT' => '0.1em',
		'PADDING-RIGHT' => '0.1em',
		'PADDING-TOP' => '0.1em',
		'PADDING-BOTTOM' => '0.1em',
	),
	'CAPTION' => array(
		'TEXT-ALIGN' => 'center',
	),
	'IMG' => array(
		'MARGIN' => '0',
		'VERTICAL-ALIGN' => 'baseline',
	),
	'INPUT' => array(
		'FONT-FAMILY' => 'sans-serif',
		'VERTICAL-ALIGN' => 'middle',
		'FONT-SIZE' => '0.9em',
	),
	'SELECT' => array(
		'FONT-FAMILY' => 'sans-serif',
		'FONT-SIZE' => '0.9em',
		'VERTICAL-ALIGN' => 'middle',
	),
	'TEXTAREA' => array(
		'FONT-FAMILY' => 'monospace',
		'FONT-SIZE' => '0.9em',
		'VERTICAL-ALIGN' => 'text-bottom',
	),
	'MARK' => array(	/* mPDF 5.5.09 */
		'BACKGROUND-COLOR' => 'yellow',
	),
);
$this->pdf_version = '1.4';
$this->SHYlanguages = array('en','de','es','fi','fr','it','nl','pl','ru','sv');	// existing defined patterns
$this->default_lineheight_correction=1.2;	// Value 1 sets lineheight=fontsize height; 
$this->fontsizes = array('XX-SMALL'=>0.7, 'X-SMALL'=>0.77, 'SMALL'=>0.86, 'MEDIUM'=>1, 'LARGE'=>1.2, 'X-LARGE'=>1.5, 'XX-LARGE'=>2);
	$this->pregRTLchars = "\x{0590}-\x{06FF}\x{0700}-\x{083E}\x{FB00}-\x{FDFD}\x{FE70}-\x{FEFF}";	
	$this->pregUHCchars = "\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}";
	$this->pregSJISchars = "\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{3190}-\x{319F}\x{31F0}-\x{31FF}";	
	$this->pregCJKchars = "\x{1100}-\x{11FF}\x{2E80}-\x{A4CF}\x{A800}-\x{D7AF}\x{F900}-\x{FAFF}\x{FE30}-\x{FE6F}\x{FF00}-\x{FFEF}\x{20000}-\x{2FA1F}";
	$this->CJKleading = "\$\(\*\[\{\x{00a3}\x{00a5}\x{00ab}\x{00b7}\x{2018}\x{201c}\x{2035}\x{3005}\x{3007}\x{3008}\x{300a}\x{300c}\x{300e}\x{3010}\x{3014}\x{3016}\x{3018}\x{301d}\x{fe34}\x{fe57}\x{fe59}\x{fe5b}\x{ff04}\x{ff08}\x{ff0e}\x{ff3b}\x{ff5b}\x{ff5f}\x{ffe1}\x{ffe5}\x{ffe6}";
	$this->CJKfollowing = "!%\),\.:;>\?\]\}\x{00a2}\x{00a8}\x{00b0}\x{00b7}\x{00bb}\x{02c7}\x{02c9}\x{2010}\x{2013}-\x{2016}\x{2019}\x{201d}-\x{201f}\x{2020}-\x{2022}\x{2025}\x{2027}\x{203a}\x{203c}\x{2047}-\x{2049}\x{2103}\x{2236}\x{2574}\x{3001}-\x{3003}\x{3005}\x{3006}\x{3009}\x{300b}\x{300d}\x{300f}\x{3011}\x{3015}\x{3017}\x{3019}\x{301c}\x{301e}\x{301f}\x{303b}\x{3041}\x{3043}\x{3045}\x{3047}\x{3049}\x{3063}\x{3083}\x{3085}\x{3087}\x{308e}\x{3095}\x{3096}\x{30a0}\x{30a1}\x{30a3}\x{30a5}\x{30a7}\x{30a9}\x{30c3}\x{30e3}\x{30e5}\x{30e7}\x{30ee}\x{30f5}\x{30f6}\x{30fb}-\x{30fe}\x{31f0}-\x{31ff}\x{fe30}-\x{fe33}\x{fe50}-\x{fe56}\x{fe58}\x{fe5a}\x{fe5c}\x{ff01}\x{ff02}\x{ff05}\x{ff07}\x{ff09}\x{ff0c}\x{ff0e}\x{ff1a}\x{ff1b}\x{ff1f}\x{ff3d}\x{ff40}\x{ff5c}-\x{ff5e}\x{ff60}\x{ff64}";
	$this->CJKoverflow = "\.,\x{ff61}\x{ff64}\x{3001}\x{3002}\x{ff0c}\x{ff0e}";
	$this->pregASCIIchars1 = "\x{0021}-\x{002E}\x{0030}-\x{003B}?";	// no [SPACE]
	$this->pregASCIIchars2 = "\x{0020}-\x{002E}\x{0030}-\x{003B}?";	// [SPACE] punctuation and 0-9
	$this->pregASCIIchars3 = "\x{0000}-\x{002E}\x{0030}-\x{003B}\x{003F}-\x{007E}";	// all except <>
	$this->pregVIETchars = "\x{01A0}\x{01A1}\x{01AF}\x{01B0}\x{1EA0}-\x{1EF1}";	
	$this->pregVIETPluschars = "\x{0000}-\x{003B}\x{003F}-\x{00FF}\x{0300}-\x{036F}\x{0102}\x{0103}\x{0110}\x{0111}\x{0128}\x{0129}\x{0168}\x{0169}\x{1EF1}-\x{1EF9}";	// omits < >
	$this->pregARABICchars = "\x{0600}-\x{06FF}\x{0750}-\x{077F}\x{FB50}-\x{FDFD}\x{FE70}-\x{FEFF}";
	$this->pregNonARABICchars = "\x{0671}-\x{067D}\x{067F}-\x{0685}\x{0687}-\x{0697}\x{0699}-\x{06A8}\x{06AA}-\x{06AE}\x{06B0}-\x{06CB}\x{06CD}-\x{06D3}";
	$this->pregHEBchars = "\x{0590}-\x{05FF}\x{FB00}-\x{FB49}";	// Hebrew
	$this->pregHIchars = "\x{0900}-\x{0963}\x{0966}-\x{097F}";	// Devanagari (Hindi) minus the common indic punctuation 0964,0965
	$this->pregBNchars = "\x{0980}-\x{09FF}";	// Bengali 
	$this->pregPAchars = "\x{0A00}-\x{0A7F}";	// Gurmukhi (Punjabi)
	$this->pregGUchars = "\x{0A80}-\x{0AFF}";	// Gujarati
	$this->pregORchars = "\x{0B00}-\x{0B7F}";	// Oriya 
	$this->pregTAchars = "\x{0B80}-\x{0BFF}";	// Tamil 
	$this->pregTEchars = "\x{0C00}-\x{0C7F}";	// Telugu 
	$this->pregKNchars = "\x{0C80}-\x{0CFF}";	// Kannada 
	$this->pregMLchars = "\x{0D00}-\x{0D7F}";	// Malayalam 
	$this->pregSHchars = "\x{0D80}-\x{0DFF}";	// Sinhala 

	$this->pregINDextra = "\x{200B}-\x{200D}\x{0964}\x{0965}\x{0020}-\x{0022}\x{0024}-\x{002E}\x{003A}-\x{003F}\x{005B}-\x{0060}\x{007B}-\x{007E}\x{00A0}";
$this->allowedCSStags = 'DIV|P|H1|H2|H3|H4|H5|H6|FORM|IMG|A|BODY|TABLE|HR|THEAD|TFOOT|TBODY|TH|TR|TD|UL|OL|LI|PRE|BLOCKQUOTE|ADDRESS|DL|DT|DD';
$this->allowedCSStags .= '|ARTICLE|ASIDE|FIGURE|FIGCAPTION|FOOTER|HEADER|HGROUP|NAV|SECTION|MARK|DETAILS|SUMMARY|METER|PROGRESS|TIME'; // mPDF 5.5.09
$this->allowedCSStags .= '|SPAN|TT|I|B|BIG|SMALL|EM|STRONG|DFN|CODE|SAMP|KBD|VAR|CITE|ABBR|ACRONYM|STRIKE|S|U|DEL|INS|Q|FONT';
$this->allowedCSStags .= '|SELECT|INPUT|TEXTAREA|CAPTION|FIELDSET|LEGEND';	// mPDF 5.4.18
$this->allowedCSStags .= '|TEXTCIRCLE|DOTTAB';	// mPDF 5.5.23	// mPDF 5.6.33
$this->outerblocktags = array('DIV','FORM','CENTER','DL','FIELDSET','ARTICLE','ASIDE','FIGURE','FIGCAPTION', 'FOOTER','HEADER','HGROUP','NAV','SECTION','DETAILS','SUMMARY');	// mPDF 5.5.09 // mPDF 5.5.22
$this->innerblocktags = array('P','BLOCKQUOTE','ADDRESS','PRE','H1','H2','H3','H4','H5','H6','DT','DD','CAPTION');
$this->useSubstitutions = true;
?>
