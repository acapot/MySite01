//Funktionen som renar text fält ("Skriv din text här") när man fokuserar sig på den
function clearText(thefield,plats){
	if (thefield.defaultValue==thefield.value)
	thefield.value = "";
	}
