
/**
 * Common
 * -------------------------------------------------------------------------------------
 * 공통 스크립트 설정 파일
 */
'use strict';


/**
 * Toast  설정 시작
 * ================================================
 * @type {Element}
 */
const toastEl = {

    toastMessageObj : document.querySelector('.common-toast'),
    placementArray : {
        TL : 'top-0 start-0',
        TC : 'top-0 start-50 translate-middle-x',
        TR : 'top-0 end-0',
        ML : 'top-50 start-0 translate-middle-y',
        MC : 'top-50 start-50 translate-middle',
        MR : 'top-50 end-0 translate-middle-y',
        BL : 'bottom-0 start-0',
        BC : 'bottom-0 start-50 translate-middle-x',
        BR : 'bottom-0 end-0'
    },
    typeArray : {
        primary     : 'bg-primary',
        secondary   : 'bg-secondary',
        success     : 'bg-success',
        danger      : 'bg-danger',
        warning     : 'bg-warning',
        info        : 'bg-info',
        dark        : 'bg-dark',
    },
    selectedType        : 'primary',
    selectedPlacement   : 'BR',
    toastPlacement : '',


    // toastDelete
    toastDispose : function (toast) {
        console.log(toast);
        if (toast && toast._element !== null) {
            console.log('toast delete2')
            if (this.toastMessageObj) {
                this.toastMessageObj.classList.remove(this.selectedType);
                this.toastMessageObj.classList.remove(...this.selectedPlacement);
            }
            toast.dispose();
        }
    },

    // toastShow
    toastShow : function(sType, sPlace, sMessage, sTitle='알림'){
        const childMessage = this.toastMessageObj.querySelector('.toast-body');
        const childTitle = this.toastMessageObj.querySelector('.toast-title');
        childMessage.innerHTML="";
        childTitle.innerHTML="";

        if (this.selectedPlacement) {
            this.toastDispose(this.toastPlacement);
        }
        this.selectedType = this.typeArray[sType];
        this.selectedPlacement = this.placementArray[sPlace].split(' ');

        this.toastMessageObj.classList.add(this.selectedType);
        this.toastMessageObj.classList.add(...this.selectedPlacement);
        childMessage.innerHTML = sMessage;
        childTitle.innerHTML = sTitle;
        this.toastPlacement = new bootstrap.Toast(this.toastMessageObj);
        this.toastPlacement.show();
    }
}



