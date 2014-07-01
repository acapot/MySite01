// JavaScript with objects for managing of events

// --- API ---

// appendEventHandler (elem,evtStr,handler,useCapture)
//	Add an event handler to the element
//		elem = Reference to the element object
//		evtStr = A string with the event, e.g. "click"
//		handler = A reference to the function, wich is to be called when the event occurrs
//		useCapture = true/false. For normal event handling false is used.
//			True is used if you want to trigger all events for the element,
//			so it is not first capured by any child element. This is e.g. used for drag-and-drop.

// removeEventHandler (elem,evtStr,handler,useCapture)
//	Remove the event handler from the element elem. Remove events attached by appendEventHandler
//		The arguments are the same as for appendEventHandler

// stopEvent (evt)
//	Stop event "bubbling" and default behaviour, so the event will not be captured by any other element
//		evt = Reference to the event object

// eventElem (evt)
//	Get a reference to the element where the event occurred
//		evt = Reference to the event object

function appendEventHandler(elem,evtStr,handler,useCapture) { // Add event handler to the element
    if (evtStr.substr(0,2) == "on") evtStr = evtStr.substr(2); // If evtStr begins with on, then remove on
	if (elem.addEventListener) elem.addEventListener(evtStr,handler,useCapture);
	else if (elem.attachEvent) elem.attachEvent("on"+evtStr,handler);
	else elem["on"+evtStr] = handler;
} // End appendEventHandler
   
function removeEventHandler(elem,evtStr,handler,useCapture) { // Remove the event handler
  	if (evtStr.substr(0,2) == "on") evtStr = evtStr.substr(2); // If evtStr begins with on, then remove on
	if (elem.removeEventListener) elem.removeEventListener(evtStr,handler,useCapture);
	else if (elem.detachEvent) elem.detachEvent("on"+evtStr,handler);
	else elem["on"+evtStr] = "";
} // End removeEventHandler
   
function stopEvent(evt) { // Stop event "bubbling" and default behaviour
	if (evt.stopPropagation) { // Mozilla (e.g. Firefox)
	  evt.stopPropagation();
	  evt.preventDefault();
	}
	else { // Internet Explorer
	  evt.cancelBubble = true;
	  evt.returnValue = false;
	}
} // End stopEvent
   
function getEventElem(evt) { // Get a reference to the element where the event occurred
    if (evt.target) return evt.target; // Mozilla (e.g. Firefox)
    else if (evt.srcElement) return evt.srcElement; // Internet Explorer
    else return null; // Old browser
} // End eventElem