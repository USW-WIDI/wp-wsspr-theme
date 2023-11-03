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

// Corrects any legacy WSSPR URIs 
// TEMPORARY solution
function legacy_uri_correction()
{
    var anchors = iframe.contentWindow.document.body.getElementsByTagName("a");
    console.log(anchors);
    console.log(anchors.length);
    for (var i = 0; i < anchors.length; i++)
    {
        anchors[i].href = anchors[i].href.replace("http://144.126.230.165", "https://splossary.wales");
        anchors[i].title = anchors[i].title.replace("http://144.126.230.165", "https://splossary.wales");
    }
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

                        setTimeout(function() { legacy_uri_correction(); }, 250);
                        setTimeout(function() { legacy_uri_correction(); }, 500);
                        setTimeout(function() { legacy_uri_correction(); }, 1000);
                        setTimeout(function() { legacy_uri_correction(); }, 2000);
                        setTimeout(function() { legacy_uri_correction(); }, 4000);
                    });
                });
            });
        });
    });
};


/*
    Mobile menu functions
*/

function open_nav()
{
  document.getElementById("mobile-menu-itms").style.display = "block";
}

function open_nav_via_key(e)
{
    if(e.keyCode === 13)
    {
        e.preventDefault();
        open_nav();
    }
}

function close_nav()
{
  document.getElementById("mobile-menu-itms").style.display = "none";
}