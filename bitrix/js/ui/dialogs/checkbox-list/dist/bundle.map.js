{"version":3,"file":"bundle.map.js","names":["this","BX","exports","checkboxList_css","main_popup","ui_designTokens","ui_vue3","ui_forms","ui_switcher","main_core_events","main_core","viewMode","view","edit","CheckboxListOption","props","data","titleData","title","isCheckedValue","isChecked","methods","getId","id","getValue","setValue","value","getTitle","_this$$refs$title$inn","_this$$refs$title","$refs","innerText","setTitle","setStateFromProps","getOptionClassName","isLocked","isViewMode","getLabelClassName","isEditMode","emitHandleCheckBox","event","setTimeout","isEditable","context","EventEmitter","emit","handleCheckBox","target","checked","onToggleViewMode","$nextTick","setFocusOnTitle","focus","range","document","createRange","selection","window","getSelection","selectNodeContents","collapse","removeAllRanges","addRange","onChangeTitle","computed","labelClassName","template","CheckboxListCategory","components","setRef","ref","setOptionRef","CheckboxComponent","dataTitle","dataId","handleClick","key","$emit","TextToggleComponent","index","dataItems","findIndex","item","length","currentLabel","_this$dataItems$find","Type","isArrayFilled","label","find","CheckboxListSections","getSectionsItemClassName","sectionValue","Content","dataSections","sections","dataCategories","categories","dataCompactField","compactField","dataOptions","getPreparedDataOptions","dataParams","getPreparedParams","optionsRef","Map","search","longContent","scrollIsBottom","scrollIsTop","options","map","option","_params$useSearch","_params$useSectioning","_params$closeAfterApp","_params$showBackToDef","_params$isEditableOpt","_params$destroyPopupA","params","useSearch","Boolean","useSectioning","closeAfterApply","showBackToDefaultSettings","isEditableOptionsTitle","destroyPopupAfterClose","renderSwitcher","UI","Switcher","node","switcher","size","handlers","toggled","handleSwitcherToggled","clearSearch","handleClearSearchButtonClick","setFocusToSearchInput","_this$$refs","_this$$refs$searchInp","searchInput","handleSectionsToggled","section","getOptionsByCategory","category","getOptions","filter","categoryKey","optionsByTitle","getCheckedOptionsId","getCheckedOptions","getOptionRefs","checkLongContent","container","clientHeight","scrollHeight","getBottomIndent","scrollTop","getTopIndent","handleScroll","handleSearchEscKeyUp","defaultSettings","BaseEvent","fields","dialog","isDefaultPrevented","defaultValue","click","setDefaultValuesForOptions","forEach","get","toggleOption","onSelectAllClick","isAllSelected","deselectAll","selectAll","select","values","cancel","restoreOptionValues","destroyOrClosePopup","apply","isCheckedCheckboxes","eventParams","titles","getOptionTitles","adjustOptions","checkedFieldIds","includes","set","destroyPopup","closePopup","popup","destroy","close","isAllSectionsDisabled","every","watch","categoryBySection","visibleOptions","sectionKey","isEmptyContent","isNarrowWidth","innerWidth","isSearchDisabled","some","locked","toLowerCase","wrapperClassName","searchClassName","applyClassName","selectAllClassName","switcherText","isStringFilled","lang","Loc","getMessage","placeholderText","placeholder","defaultSettingsBtnText","defaultBtn","applyBtnText","acceptBtn","cancelBtnText","cancelBtn","selectAllBtnText","selectAllBtn","emptyStateTitleText","allSectionsDisabledTitle","emptyStateTitle","emptyStateDescriptionText","emptyStateDescription","isSomeSelected","selectAllCheckbox","indeterminate","mounted","_getColumnCount","babelHelpers","classPrivateFieldLooseKey","_getLayoutComponent","CheckboxList","constructor","_this$params$useSecti","super","Object","defineProperty","_getLayoutComponent2","_getColumnCount2","layoutApp","layoutComponent","setEventNamespace","subscribeFromOptions","events","isPlainObject","isArray","columnCount","isNumber","popupOptions","Error","customFooterElements","isBoolean","getPopup","Dom","create","addClass","innerHeight","Popup","className","width","maxWidth","Math","round","overlay","autoHide","minHeight","maxHeight","borderRadius","contentPadding","contentBackground","animation","titleBar","content","closeIcon","closeByEsc","onPopupClose","BitrixVue","createApp","classPrivateFieldLooseBase","mount","show","hide","_this$layoutComponent","unmount","isShown","getSelectedOptions","handleOptionToggled","saveColumns","columnIds","callback","selectOption","Main","Vue3","Event"],"sources":["bundle.js"],"mappings":"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"}