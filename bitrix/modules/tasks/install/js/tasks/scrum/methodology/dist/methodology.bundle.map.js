{"version":3,"file":"methodology.bundle.map.js","names":["this","BX","Tasks","exports","ui_manual","ui_popupcomponentsmaker","main_core","ui_dialogs_messagebox","main_core_events","RequestSender","babelHelpers","classCallCheck","createClass","key","value","sendRequest","controller","action","data","arguments","length","undefined","Promise","resolve","reject","ajax","runAction","then","getEpicInfo","getDodInfo","getTeamSpeedInfo","getTutorInfo","getBurnDownInfo","getMarketPath","showErrorAlert","response","alertTitle","Type","isUndefined","errors","console","error","firstError","shift","errorCode","code","message","title","Loc","getMessage","MessageBox","alert","SidePanel","_EventEmitter","inherits","_this","possibleConstructorReturn","getPrototypeOf","call","setEventNamespace","sidePanelManager","Instance","openSidePanelByUrl","url","open","openSidePanel","id","options","showByExtension","name","params","extensionName","toLowerCase","top","Runtime","loadExtension","replaceAll","extension","show","EventEmitter","_templateObject","_templateObject2","_templateObject3","_templateObject4","_templateObject5","_templateObject6","Methodology","groupId","parseInt","teamSpeedPath","isString","burnDownPath","pathToTask","requestSender","sidePanel","menu","hintManager","showMenu","targetNode","isShown","close","PopupComponentsMaker","target","cacheable","content","html","renderEpics","backgroundColor","renderDod","renderTeamSpeed","renderBurnDown","renderTutor","renderMigration","existsEpic","buttonText","buttonClass","iconClass","blockClass","baseClasses","node","Tag","render","taggedTemplateLiteral","initHints","Event","bind","querySelector","showEpics","createEpic","_this2","existsDod","showDodSettings","_this3","isDisabled","existsCompletedSprint","btnUiClasses","disableClass","showTeamSpeedChart","_this4","existsChart","isNull","sprint","showBurnDownChart","_this5","tutorClasses","Manual","urlParams","scrum","_this6","migrationClasses","marketUri","uri","Uri","setQueryParam","toString","view","Scrum","EpicInstance","Error","analyticsLabel","sprintId","replace","UI","Hint","createInstance","popupParameters","closeByEsc","autoHide","init","Dialogs"],"sources":["methodology.bundle.js"],"mappings":"AAAAA,KAAKC,GAAKD,KAAKC,IAAM,CAAC,EACtBD,KAAKC,GAAGC,MAAQF,KAAKC,GAAGC,OAAS,CAAC,GACjC,SAAUC,EAAQC,EAAUC,EAAwBC,EAAUC,EAAsBC,GACpF,aAEA,IAAIC,EAA6B,WAC/B,SAASA,IACPC,aAAaC,eAAeX,KAAMS,EACpC,CACAC,aAAaE,YAAYH,EAAe,CAAC,CACvCI,IAAK,cACLC,MAAO,SAASC,EAAYC,EAAYC,GACtC,IAAIC,EAAOC,UAAUC,OAAS,GAAKD,UAAU,KAAOE,UAAYF,UAAU,GAAK,CAAC,EAChF,OAAO,IAAIG,SAAQ,SAAUC,EAASC,GACpClB,EAAUmB,KAAKC,UAAU,sBAAwBV,EAAa,IAAMC,EAAQ,CAC1EC,KAAMA,IACLS,KAAKJ,EAASC,EACnB,GACF,GACC,CACDX,IAAK,cACLC,MAAO,SAASc,EAAYV,GAC1B,OAAOlB,KAAKe,YAAY,OAAQ,cAAeG,EACjD,GACC,CACDL,IAAK,aACLC,MAAO,SAASe,EAAWX,GACzB,OAAOlB,KAAKe,YAAY,MAAO,aAAcG,EAC/C,GACC,CACDL,IAAK,mBACLC,MAAO,SAASgB,EAAiBZ,GAC/B,OAAOlB,KAAKe,YAAY,SAAU,mBAAoBG,EACxD,GACC,CACDL,IAAK,eACLC,MAAO,SAASiB,EAAab,GAC3B,OAAOlB,KAAKe,YAAY,OAAQ,eAAgBG,EAClD,GACC,CACDL,IAAK,kBACLC,MAAO,SAASkB,EAAgBd,GAC9B,OAAOlB,KAAKe,YAAY,SAAU,kBAAmBG,EACvD,GACC,CACDL,IAAK,gBACLC,MAAO,SAASmB,IACd,OAAOjC,KAAKe,YAAY,OAAQ,gBAClC,GACC,CACDF,IAAK,iBACLC,MAAO,SAASoB,EAAeC,EAAUC,GACvC,GAAI9B,EAAU+B,KAAKC,YAAYH,EAASI,QAAS,CAC/CC,QAAQC,MAAMN,GACd,MACF,CACA,GAAIA,EAASI,OAAOnB,OAAQ,CAC1B,IAAIsB,EAAaP,EAASI,OAAOI,QACjC,GAAID,EAAY,CACd,IAAIE,EAAYF,EAAWG,KAAOH,EAAWG,KAAO,GACpD,IAAIC,EAAUJ,EAAWI,QAAU,IAAMF,EACzC,IAAIG,EAAQX,EAAaA,EAAa9B,EAAU0C,IAAIC,WAAW,yBAC/D1C,EAAsB2C,WAAWC,MAAML,EAASC,EAClD,CACF,CACF,KAEF,OAAOtC,CACT,CA/DiC,GAiEjC,IAAI2C,EAAyB,SAAUC,GACrC3C,aAAa4C,SAASF,EAAWC,GACjC,SAASD,IACP,IAAIG,EACJ7C,aAAaC,eAAeX,KAAMoD,GAClCG,EAAQ7C,aAAa8C,0BAA0BxD,KAAMU,aAAa+C,eAAeL,GAAWM,KAAK1D,OACjGuD,EAAMI,kBAAkB,wCAGxBJ,EAAMK,iBAAmB3D,GAAGmD,UAAUS,SAEtC,OAAON,CACT,CACA7C,aAAaE,YAAYwC,EAAW,CAAC,CACnCvC,IAAK,qBACLC,MAAO,SAASgD,EAAmBC,GACjC/D,KAAK4D,iBAAiBI,KAAKD,EAC7B,GACC,CACDlD,IAAK,gBACLC,MAAO,SAASmD,EAAcC,EAAIC,GAChCnE,KAAK4D,iBAAiBI,KAAKE,EAAIC,EACjC,GACC,CACDtD,IAAK,kBACLC,MAAO,SAASsD,EAAgBC,EAAMC,GACpC,IAAIC,EAAgB,eAAiBF,EAAKG,cAC1C,OAAOC,IAAIxE,GAAGyE,QAAQC,cAAcJ,GAAe5C,MAAK,SAAUxB,GAChEkE,EAAOA,EAAKO,WAAW,IAAK,IAC5B,GAAIzE,GAAWA,EAAQkE,GAAO,CAC5B,IAAIQ,EAAY,IAAI1E,EAAQkE,GAAMC,GAClCO,EAAUC,OACV,OAAOD,CACT,KAAO,CACL,OAAO,IACT,CACF,GACF,KAEF,OAAOzB,CACT,CAxC6B,CAwC3B5C,EAAiBuE,cAEnB,IAAIC,EAAiBC,EAAkBC,EAAkBC,EAAkBC,EAAkBC,EAC7F,IAAIC,EAA2B,WAC7B,SAASA,EAAYhB,GACnB5D,aAAaC,eAAeX,KAAMsF,GAClCtF,KAAKuF,QAAUC,SAASlB,EAAOiB,QAAS,IACxCvF,KAAKyF,cAAgBnF,EAAU+B,KAAKqD,SAASpB,EAAOmB,eAAiBnB,EAAOmB,cAAgB,GAC5FzF,KAAK2F,aAAerF,EAAU+B,KAAKqD,SAASpB,EAAOqB,cAAgBrB,EAAOqB,aAAe,GACzF3F,KAAK4F,WAAatF,EAAU+B,KAAKqD,SAASpB,EAAOsB,YAActB,EAAOsB,WAAa,GACnF5F,KAAK6F,cAAgB,IAAIpF,EACzBT,KAAK8F,UAAY,IAAI1C,EACrBpD,KAAK+F,KAAO,KACZ/F,KAAKgG,YAAc,IACrB,CACAtF,aAAaE,YAAY0E,EAAa,CAAC,CACrCzE,IAAK,WACLC,MAAO,SAASmF,EAASC,GACvB,GAAIlG,KAAK+F,KAAM,CACb,GAAI/F,KAAK+F,KAAKI,UAAW,CACvBnG,KAAK+F,KAAKK,QACV,MACF,CACF,CACApG,KAAK+F,KAAO,IAAI1F,EAAwBgG,qBAAqB,CAC3DnC,GAAI,iCACJoC,OAAQJ,EACRK,UAAW,MACXC,QAAS,CAAC,CACRC,KAAM,CAAC,CACLA,KAAMzG,KAAK0G,cACXC,gBAAiB,WAChB,CACDF,KAAMzG,KAAK4G,YACXD,gBAAiB,aAElB,CACDF,KAAM,CAAC,CACLA,KAAMzG,KAAK6G,qBAEZ,CACDJ,KAAM,CAAC,CACLA,KAAMzG,KAAK8G,oBAEZ,CACDL,KAAM,CAAC,CACLA,KAAMzG,KAAK+G,cACXJ,gBAAiB,aAElB,CACDF,KAAM,CAAC,CACLA,KAAMzG,KAAKgH,wBAIjBhH,KAAK+F,KAAKjB,MACZ,GACC,CACDjE,IAAK,cACLC,MAAO,SAAS4F,IACd,IAAInD,EAAQvD,KACZ,OAAOA,KAAK6F,cAAcjE,YAAY,CACpC2D,QAASvF,KAAKuF,UACb5D,MAAK,SAAUQ,GAChB,IAAI8E,EAAa9E,EAASjB,KAAK+F,WAC/B,IAAIC,EAAaD,EAAa3G,EAAU0C,IAAIC,WAAW,wBAA0B3C,EAAU0C,IAAIC,WAAW,0BAC1G,IAAIkE,EAAcF,EAAa,WAAa,GAC5C,IAAIG,EAAYH,EAAa,wBAA0B,8BACvD,IAAII,EAAaJ,EAAa,WAAa,GAC3C,IAAIK,EAAc,yEAClB,IAAIC,EAAOjH,EAAUkH,IAAIC,OAAOzC,IAAoBA,EAAkBtE,aAAagH,sBAAsB,CAAC,2BAA6B,wCAAyC,gIAAqI,6OAAmP,6GAAmH,2NAAgO,2FAA+F,iIAAkIJ,EAAaD,EAAYD,EAAW9G,EAAU0C,IAAIC,WAAW,kBAAmB3C,EAAU0C,IAAIC,WAAW,iBAAkBkE,EAAaD,GACpuC3D,EAAMoE,UAAUJ,GAChBjH,EAAUsH,MAAMC,KAAKN,EAAKO,cAAc,UAAW,SAAS,WAC1D,GAAIb,EAAY,CACd1D,EAAMwE,WACR,KAAO,CACLxE,EAAMyE,YACR,CACF,IACA,OAAOT,CACT,IAAG,UAAS,SAAUpF,GACpBoB,EAAMsC,cAAc3D,eAAeC,EACrC,GACF,GACC,CACDtB,IAAK,YACLC,MAAO,SAAS8F,IACd,IAAIqB,EAASjI,KACb,OAAOA,KAAK6F,cAAchE,WAAW,CACnC0D,QAASvF,KAAKuF,UACb5D,MAAK,SAAUQ,GAChB,IAAI+F,EAAY/F,EAASjB,KAAKgH,UAC9B,IAAIhB,EAAagB,EAAY5H,EAAU0C,IAAIC,WAAW,uBAAyB3C,EAAU0C,IAAIC,WAAW,yBACxG,IAAIkE,EAAce,EAAY,WAAa,GAC3C,IAAId,EAAYc,EAAY,sBAAwB,4BACpD,IAAIb,EAAaa,EAAY,WAAa,GAC1C,IAAIX,EAAOjH,EAAUkH,IAAIC,OAAOxC,IAAqBA,EAAmBvE,aAAagH,sBAAsB,CAAC,sIAAwI,gIAAqI,6OAAmP,6GAAmH,2NAAgO,yFAA6F,iIAAkIL,EAAYD,EAAW9G,EAAU0C,IAAIC,WAAW,qBAAsB3C,EAAU0C,IAAIC,WAAW,oBAAqBkE,EAAaD,GAC/xCe,EAAON,UAAUJ,GACjBjH,EAAUsH,MAAMC,KAAKN,EAAKO,cAAc,UAAW,QAASG,EAAOE,gBAAgBN,KAAKI,IACxF,OAAOV,CACT,IAAG,UAAS,SAAUpF,GACpB8F,EAAOpC,cAAc3D,eAAeC,EACtC,GACF,GACC,CACDtB,IAAK,kBACLC,MAAO,SAAS+F,IACd,IAAIuB,EAASpI,KACb,OAAOA,KAAK6F,cAAc/D,iBAAiB,CACzCyD,QAASvF,KAAKuF,UACb5D,MAAK,SAAUQ,GAChB,IAAIkG,GAAclG,EAASjB,KAAKoH,sBAChC,IAAIC,EAAe,0CACnB,IAAIC,EAAeH,EAAa,aAAe,GAC/C,IAAId,EAAOjH,EAAUkH,IAAIC,OAAOvC,IAAqBA,EAAmBxE,aAAagH,sBAAsB,CAAC,yTAAiU,0DAA6D,IAAK,uBAAyB,+EAAgFc,EAAcD,EAAcC,EAAclI,EAAU0C,IAAIC,WAAW,0BAC3pB,IAAKoF,EAAY,CACf/H,EAAUsH,MAAMC,KAAKN,EAAM,QAASa,EAAOK,mBAAmBZ,KAAKO,GACrE,CACA,OAAOb,CACT,IAAG,UAAS,SAAUpF,GACpBiG,EAAOvC,cAAc3D,eAAeC,EACtC,GACF,GACC,CACDtB,IAAK,iBACLC,MAAO,SAASgG,IACd,IAAI4B,EAAS1I,KACb,OAAOA,KAAK6F,cAAc7D,gBAAgB,CACxCuD,QAASvF,KAAKuF,UACb5D,MAAK,SAAUQ,GAChB,IAAIwG,GAAerI,EAAU+B,KAAKuG,OAAOzG,EAASjB,KAAK2H,QACvD,IAAIN,EAAe,0CACnB,IAAIC,EAAeG,EAAc,GAAK,aACtC,IAAIpB,EAAOjH,EAAUkH,IAAIC,OAAOtC,IAAqBA,EAAmBzE,aAAagH,sBAAsB,CAAC,gUAAwU,0DAA6D,IAAK,uBAAyB,+EAAgFc,EAAcD,EAAcC,EAAclI,EAAU0C,IAAIC,WAAW,2BAClqB,GAAI0F,EAAa,CACfrI,EAAUsH,MAAMC,KAAKN,EAAM,QAASmB,EAAOI,kBAAkBjB,KAAKa,EAAQvG,EAASjB,KAAK2H,OAAO3E,IACjG,CACA,OAAOqD,CACT,IAAG,UAAS,SAAUpF,GACpBuG,EAAO7C,cAAc3D,eAAeC,EACtC,GACF,GACC,CACDtB,IAAK,cACLC,MAAO,SAASiG,IACd,IAAIgC,EAAS/I,KACb,OAAOA,KAAK6F,cAAc9D,aAAa,CACrCwD,QAASvF,KAAKuF,UACb5D,MAAK,SAAUQ,GAChB,IAAImF,EAAc,yEAClB,IAAI0B,EAAe,gFACnB,IAAIzB,EAAOjH,EAAUkH,IAAIC,OAAOrC,IAAqBA,EAAmB1E,aAAagH,sBAAsB,CAAC,wCAA0C,IAAK,0gBAAwhB,iIAAoI,wJAA2J,oGAAqGJ,EAAa0B,EAAc1I,EAAU0C,IAAIC,WAAW,sBAAuB3C,EAAU0C,IAAIC,WAAW,qBAAsB3C,EAAU0C,IAAIC,WAAW,yBAC1sC3C,EAAUsH,MAAMC,KAAKN,EAAM,SAAS,WAClCnH,EAAU6I,OAAOnE,KAAK,QAAS3C,EAASjB,KAAKgI,UAAW,CACtDC,MAAO,IACPlI,OAAQ,cAEZ,IACA,OAAOsG,CACT,IAAG,UAAS,SAAUpF,GACpB4G,EAAOlD,cAAc3D,eAAeC,EACtC,GACF,GACC,CACDtB,IAAK,kBACLC,MAAO,SAASkG,IACd,IAAIoC,EAASpJ,KACb,IAAIsH,EAAc,yEAClB,IAAI+B,EAAmB,iFACvB,IAAIjC,EAAY,0EAChB,IAAIG,EAAOjH,EAAUkH,IAAIC,OAAOpC,IAAqBA,EAAmB3E,aAAagH,sBAAsB,CAAC,uBAAyB,IAAK,wMAAiN,+OAAqP,2IAA8I,gFAAiFJ,EAAa+B,EAAkBjC,EAAW9G,EAAU0C,IAAIC,WAAW,uBAAwB3C,EAAU0C,IAAIC,WAAW,wBACn6BjD,KAAK6F,cAAc5D,gBAAgBN,MAAK,SAAUQ,GAChD,IAAImH,EAAYnH,EAASjB,KACzBZ,EAAUsH,MAAMC,KAAKN,EAAM,SAAS,WAClC,IAAIgC,EAAM,IAAIjJ,EAAUkJ,IAAIF,GAC5BC,EAAIE,cAAc,MAAO,CAAC,WAAY,UACtCL,EAAOtD,UAAUhC,mBAAmByF,EAAIG,YACxCN,EAAOrD,KAAKK,OACd,GACF,IACA,OAAOmB,CACT,GACC,CACD1G,IAAK,YACLC,MAAO,SAASiH,IACd/H,KAAK8F,UAAU1B,gBAAgB,OAAQ,CACrCuF,KAAM,OACNpE,QAASvF,KAAKuF,QACdK,WAAY5F,KAAK4F,aAChBjE,MAAK,SAAUkD,GAChB5E,GAAGC,MAAM0J,MAAMC,aAAehF,CAChC,IACA7E,KAAK+F,KAAKK,OACZ,GACC,CACDvF,IAAK,aACLC,MAAO,SAASkH,IACdhI,KAAK8F,UAAU1B,gBAAgB,OAAQ,CACrCuF,KAAM,MACNpE,QAASvF,KAAKuF,UAEhBvF,KAAK+F,KAAKK,OACZ,GACC,CACDvF,IAAK,kBACLC,MAAO,SAASqH,IACdnI,KAAK8F,UAAU1B,gBAAgB,MAAO,CACpCuF,KAAM,WACNpE,QAASvF,KAAKuF,UAEhBvF,KAAK+F,KAAKK,OACZ,GACC,CACDvF,IAAK,qBACLC,MAAO,SAAS2H,IACd,GAAIzI,KAAKyF,cAAe,CACtBzF,KAAK8F,UAAU7B,cAAcjE,KAAKyF,cACpC,KAAO,CACL,MAAM,IAAIqE,MAAM,8CAClB,CACA9J,KAAK+F,KAAKK,QACV9F,EAAUmB,KAAKC,UAAU,6CAA8C,CACrER,KAAM,CAAC,EACP6I,eAAgB,CACdZ,MAAO,IACPlI,OAAQ,yBAGd,GACC,CACDJ,IAAK,oBACLC,MAAO,SAASgI,EAAkBkB,GAChC,GAAIhK,KAAK2F,aAAc,CACrB3F,KAAK8F,UAAU7B,cAAcjE,KAAK2F,aAAasE,QAAQ,cAAeD,GACxE,KAAO,CACL,MAAM,IAAIF,MAAM,8CAClB,CACA9J,KAAK+F,KAAKK,QACV9F,EAAUmB,KAAKC,UAAU,6CAA8C,CACrER,KAAM,CAAC,EACP6I,eAAgB,CACdZ,MAAO,IACPlI,OAAQ,mBAGd,GACC,CACDJ,IAAK,YACLC,MAAO,SAAS6G,EAAUJ,GACxBvH,KAAKgG,YAAc/F,GAAGiK,GAAGC,KAAKC,eAAe,CAC3CC,gBAAiB,CACfC,WAAY,KACZC,SAAU,QAGdvK,KAAKgG,YAAYwE,KAAKjD,EACxB,KAEF,OAAOjC,CACT,CAhQ+B,GAkQ/BnF,EAAQmF,YAAcA,CAEvB,EAnXA,CAmXGtF,KAAKC,GAAGC,MAAM0J,MAAQ5J,KAAKC,GAAGC,MAAM0J,OAAS,CAAC,EAAG3J,GAAGiK,GAAGjB,OAAOhJ,GAAGiK,GAAGjK,GAAGA,GAAGiK,GAAGO,QAAQxK,GAAG2H"}