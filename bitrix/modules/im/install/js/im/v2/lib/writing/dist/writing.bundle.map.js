{"version":3,"file":"writing.bundle.map.js","names":["this","BX","Messenger","v2","exports","im_v2_application_core","im_v2_const","writingTimeByChatType","ChatType","copilot","default","_instance","babelHelpers","classPrivateFieldLooseKey","_writingTimers","_alreadyWriting","_buildTimerId","_setTimer","_clearTimer","_updateChatWritingList","_getWritingTime","_getChat","WritingManager","constructor","Object","defineProperty","value","_getChat2","_getWritingTime2","_updateChatWritingList2","_clearTimer2","_setTimer2","_buildTimerId2","_alreadyWriting2","writable","static","classPrivateFieldLooseBase","startWriting","payload","dialogId","userId","userName","chat","timerId","newWritingList","writingList","stopWriting","filter","item","some","el","writingStatusTime","setTimeout","clearTimeout","Core","getStore","dispatch","fields","_writingTimeByChatTyp","type","getters","Lib","Application","Const"],"sources":["writing.bundle.js"],"mappings":"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"}