/******************************************************************

Script: Support for WSSPR theme

******************************************************************/

var iframe = document.getElementsByClassName("pdfjs-iframe")[0];

function waitForEle(selector){
    return new Promise(resolve => {
        if (iframe.contentWindow.document.querySelector(selector)) {
            return resolve(iframe.contentWindow.document.querySelector(selector));
        }

        const observer = new MutationObserver(mutations => {
            if (iframe.contentWindow.document.querySelector(selector)) {
                observer.disconnect();
                resolve(iframe.contentWindow.document.querySelector(selector));
            }
        });

        observer.observe(iframe.contentWindow.document.body, {
            childList: true,
            subtree: true
        });
    });
}

iframe.onload = function()
{
    waitForEle('.toolbar').then((ele) =>
    {
        ele.style.display = "none";

        waitForEle('#viewerContainer').then((ele2) =>
        {
            ele2.style.top = 0;

            waitForEle('.pdfViewer').then((ele3) =>
            {
                ele3.style.backgroundColor = "white";

                waitForEle('.pdfViewer .page').then((ele4) =>
                {
                    ele4.style.border = 0;
                    ele4.style.padding = 0;
                    
                    waitForEle('#viewerContainer').then((ele5) =>
                    {
                        ele5.style.backgroundColor = "white";

                        var link = document.createElement('link');
                        
                        link.rel = "stylesheet";
                        link.type = "text/css";
                        link.href = "https://splossary.wales/wp-content/themes/wp-wsspr-theme/library/css/iframe.css";

                        var doc = document.getElementsByClassName('pdfjs-iframe')[0].contentWindow.document.head;
                        doc.append(link);

                    });
                });
            });
        });
    });
};