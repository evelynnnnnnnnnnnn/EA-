{"version":3,"file":"toolbar.bundle.map.js","names":["this","BX","exports","main_popup","main_core","market_ratingStore","ui_vue3_pinia","_","t","_t","Toolbar","props","data","hoverCategory","searchFocus","catalogShown","dropdownShown","searchResult","search","text","notFoundText","loader","loader2","currentPage","pages","foundApps","menuPopup","computed","getSearchLink","categories","BANNER_INFO","SEARCH_LINK","created","onSearch","debounce","runSearch","mounted","bindEvents","createPopupMenu","methods","$Bitrix","eventEmitter","subscribe","closeToolbarPopup","Event","bind","$refs","searchAutoScroll","event","needLoadNextPage","currentTarget","loadItems","marketSearchInput","code","toLowerCase","cleanSearch","closeDropdown","blur","stopPropagation","document","body","menuInfo","type","isArray","menu","menuItem","forEach","item","html","NAME","href","PATH","className","PARAMS","DELIMITER","push","id","delimiter","INSTALLED_LIST","NEED_UPDATE_LIST","onclick","$root","emitLoadContent","DATASET","dataset","LOAD_CONTENT","loadContent","IGNORE_AUTOBINDING","sliderIgnoreAutobinding","length","MenuManager","create","querySelector","closeByEsc","autoHide","angle","offsetLeft","showMenu","toggle","el","scrollHeight","scrollTop","offsetHeight","onPopupClick","target","closest","onSearchButtonClick","focus","setSearchFocus","close","mouseOverCategory","categoryIndex","showSubCategories","showDropdown","catalogClick","cleanSearchFocus","marketToolbar","catalogPopup","style","top","clientHeight","lockBody","getPadding","curentPaddingRight","parseInt","window","getComputedStyle","paddingRight","getScrollWidth","setProperty","marketWrapper","marketWrapperInner","getElementById","marketContainerSlider","div","Tag","render","appendChild","scrollWidth","offsetWidth","clientWidth","Dom","remove","unLockBody","removeProperty","isEmptySearch","append","searchText","ajax","runAction","page","then","response","defaultSearchProcess","apps","cur_page","concat","getAppIcon","appItem","IS_SITE_TEMPLATE","SITE_PREVIEW","ICON","getAppDescription","hasOwnProperty","Type","CATEGORIES","openSubscriptionSlider","marketAction","eval","e","UI","InfoHelper","show","marketSlider","mapActions","ratingStore","template","Market","Main","Vue3","Pinia"],"sources":["toolbar.bundle.js"],"mappings":"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"}