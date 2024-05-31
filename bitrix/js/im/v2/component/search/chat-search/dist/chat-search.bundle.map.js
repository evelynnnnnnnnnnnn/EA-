{"version":3,"file":"chat-search.bundle.map.js","names":["this","BX","Messenger","v2","exports","ui_designTokens","ui_fonts_opensans","im_v2_lib_logger","im_v2_lib_search","main_core_events","im_public","im_v2_lib_menu","im_v2_lib_call","im_v2_lib_permission","main_core","im_v2_const","im_v2_lib_utils","im_v2_lib_textHighlighter","im_v2_lib_dateFormatter","im_v2_application_core","im_v2_component_elements","SEARCH_REQUEST_ENDPOINT","LOAD_LATEST_RESULTS_ENDPOINT","SAVE_ITEM_ENDPOINT","_searchConfig","babelHelpers","classPrivateFieldLooseKey","_storeUpdater","_loadLatestResultsRequest","_searchRequest","_getDialogIdAndDate","_getItemsFromRecentItems","BaseServerSearch","constructor","searchConfig","Object","defineProperty","value","_getItemsFromRecentItems2","_getDialogIdAndDate2","_searchRequest2","_loadLatestResultsRequest2","writable","classPrivateFieldLooseBase","StoreUpdater","async","query","items","update","response","recentItems","length","itemsFromRecentItems","addItemsToRecentSearchResults","dialogId","id","entityId","EntityId","config","json","getSearchConfig","ajax","runAction","Logger","warn","data","dialog","error","searchQuery","queryWords","Utils","text","getWordsFromString","map","item","_item$customData$date","_item$customData","toString","dateMessage","customData","filledRecentItems","forEach","found","find","recentItem","push","_store","_localSearch","_baseServerSearch","_localCollection","_isExtranet","SearchService","_isExtranet2","Map","Core","getStore","LocalSearch","loadLatestResults","searchLocal","localCollection","values","search","searchResult","searchItem","set","saveItemToRecentSearch","clearSessionResult","clear","sortByDate","sort","firstItem","secondItem","date","cast","getters","type","ChatType","user","extranet","SearchContextMenu","BaseMenu","super","callManager","CallManager","getInstance","permissionManager","PermissionManager","getMenuItems","getOpenItem","getCallItem","getOpenProfileItem","getChatsWithUserItem","Loc","getMessage","onclick","openChat","context","menuInstance","close","chatCanBeCalled","chatIsAllowedToCall","canPerformAction","ChatActionType","call","startCall","isUser","isBot","profileUri","getProfileLink","href","isAnyChatOpened","store","EventEmitter","emit","EventType","sidebar","open","panel","SidebarDetailBlock","chatsWithUser","standalone","bot","ItemTextByChatType","openChannel","channel","default","SearchItem","name","components","Avatar","ChatTitleWithHighlighting","props","String","required","withDate","Boolean","selected","emits","computed","AvatarSize","$store","isChat","position","workPosition","userItemText","loc","highlightText","Text","encode","chatItemText","_ItemTextByChatType$t","itemText","itemTextForTitle","formattedDate","formatDate","methods","onClick","event","$emit","nativeEvent","onRightClick","altKey","shiftKey","DateFormatter","formatByTemplate","DateTemplate","recent","phraseCode","$Bitrix","template","MyNotes","getUserId","created","contextMenuManager","beforeUnmount","destroy","CarouselUser","userId","Number","_this$user$firstName","firstName","isExtranet","SHOW_USERS_LIMIT","RecentUsersCarousel","selectMode","showMyNotes","selectedItems","Array","users","recentUsers","limit","slice","currentUserId","startsWith","isSelected","includes","key","LatestSearchResult","Loader","isLoading","searchItems","title","EmptyState","subTitle","SearchResult","isEmptyState","ChatSearch","ScrollWithGradient","searchMode","saveSearchHistory","isRecentLoading","isServerLoading","queryWasDeleted","currentServerQueries","result","usersAndChats","cleanQuery","trim","toLowerCase","showLatestSearchResult","watch","newQuery","previousQuery","searchService","startSearch","newValue","oldValue","loadRecentSearchFromServer","initSettings","searchOnServerDelayed","Runtime","debounce","searchOnServer","subscribe","errors","accessDenied","onDelete","keyPressed","onKeyPressed","unsubscribe","settings","Extension","getSettings","defaultMinTokenSize","minTokenSize","get","cleanSearchResult","stopLoader","mergedItems","mergeResults","onOpenContextMenu","isAltOrOption","openMenu","currentTarget","eventData","filter","dialogIdFromSearch","onScroll","keyboardEvent","getData","isCombination","onPressEnterKey","onPressBackspaceKey","getFirstItemFromSearchResults","onClickItem","originalItems","newItems","Component","Lib","Event","Const","Application","Elements"],"sources":["chat-search.bundle.js"],"mappings":"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"}