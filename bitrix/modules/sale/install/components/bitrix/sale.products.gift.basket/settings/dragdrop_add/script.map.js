{"version":3,"sources":["script.js"],"names":["initDraggableAddControl","params","data","JSON","parse","BX","loadScript","bx_dnd_add_waiter","DragDrop","window","propertyID","DragNDropAddParameterControl","setTimeout","items","rand","util","getRandomString","this","useBigData","propertyParams","BIG_DATA","message","JS_MESSAGES","nodes","countParamInput","getCountParamInput","activeDragNode","temporarySortNode","itemRemoved","ids","to","from","label","baseItems","getBaseItems","sortedItems","getSortedItems","variantCounts","getVariantsCountMap","dragItemClassName","lastEntered","timeOut","loadCSS","getPath","buildNodes","initDragDrop","saveData","prototype","path","JS_FILE","split","pop","join","result","k","hasOwnProperty","push","variant","VARIANT","bigData","CODE","inputValue","oInput","value","values","replace","e","propertyTr","findParent","oCont","className","propertyTds","findChildren","tagName","newTr","create","props","length","setAttribute","appendChild","parentNode","insertBefore","rootTo","getToNode","rootFrom","getFromNode","summaryInfo","bigDataControl","children","attrs","for","id","type","events","change","proxy","toggleBigData","text","summary","width","style","verticalAlign","toNode","data-value","toString","data-bigdata","title","delete","click","removeItem","dragstart","delegate","itemFromSortedList","proxy_context","dragend","disableActiveDropZone","fromNode","arrowClick","draggable","selectItem","event","dataTransfer","setData","cloneNode","addClass","drag","PreventDefault","dragdrop","_ondrag","browser","IsFirefox","sortableInterval","ondragStart","ondragEnd","removeClass","target","getEventTarget","presets","querySelectorAll","i","hasClass","getAttribute","preset","removeChild","removeSortableItem","isNodeInDom","dragItemControlClassName","sortable","rootElem","dragEnd","bind","onDragEnter","onDragOver","onDragLeave","checked","eventReturnFalse","enableActiveDropZone","getTemporaryNodeClone","addDragItem","addSortableItem","elementTo","document","elementFromPoint","pageX","pageY","contains","isSortableActive","dragNode","node","unbindAll","arr","stringify","clearTimeout","setElementCount","contentNode","elementCountInput","inputName","COUNT_PARAM_NAME","querySelector","rows","count","bigDataCount","getElementCount","quantity","quantityBigData","innerHTML","parseInt","map","COUNT"],"mappings":"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","file":""}