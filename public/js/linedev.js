var modLineDev = {};

modLineDev.count = 0;

modLineDev.getLineStatus = function () {
	$( '#linecounter' ).attr( "title", ++modLineDev.count );
};



setInterval(modLineDev.getLineStatus, 5000);
