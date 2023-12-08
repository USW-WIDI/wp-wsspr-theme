/******************************************************************

Script: Support for WSSPR theme

******************************************************************/

var iframe = null;
var iframe_legacy = null;

var iframe_test = document.getElementsByClassName("pdfjs-viewer");
var iframe_legacy_test = document.getElementsByClassName("pdfjs-iframe");

if (iframe_test.length > 0) iframe = iframe_test[0];
if (iframe_legacy_test.length > 0) iframe_legacy = iframe_legacy_test[0];



function waitForEle(selector, parent){
    return new Promise(resolve => {
        if (parent.contentWindow.document.querySelector(selector)) {
            return resolve(parent.contentWindow.document.querySelector(selector));
        }

        const observer = new MutationObserver(mutations => {
            if (parent.contentWindow.document.querySelector(selector)) {
                observer.disconnect();
                resolve(parent.contentWindow.document.querySelector(selector));
            }
        });

        observer.observe(parent.contentWindow.document.body, {
            childList: true,
            subtree: true
        });
    });
}

// Corrects any legacy WSSPR URIs 
// TEMPORARY solution
function legacy_uri_correction(parent)
{
    var anchors = parent.contentWindow.document.body.getElementsByTagName("a");
    for (var i = 0; i < anchors.length; i++)
    {
        anchors[i].href = anchors[i].href.replace("http://144.126.230.165", "https://splossary.wales");
        anchors[i].title = anchors[i].title.replace("http://144.126.230.165", "https://splossary.wales");
    }
}

function find_field_label(ele)
{
    var id = ele.id;
    labels = document.getElementsByTagName('label');

    for (var i = 0; i < labels.length; i++)
       if (labels[i].htmlFor == id)
            return labels[i];
}

function highlight_required(id)
{
    var fields = document.getElementById(id).querySelectorAll("[required]")
    
    for (var i = 0; i < fields.length; i++)
    {
        var label = find_field_label(fields[i]);
        if (!label) continue;
        else
        {
            if (fields[i].value === '')
                label.style.color = 'red';
            else 
                label.style.color = 'black';
        }
    }
}

window.addEventListener('load', function ()
{
    var reg_form = document.getElementById("wpmem_register_form");
    if (!document.body.contains(reg_form)) return;

    var reg_btns = reg_form.querySelectorAll("[type=submit]");
    for (var i = 0; i < reg_btns.length; i++)
        reg_btns[i].onclick = function(e) { highlight_required("wpmem_register_form"); }
});


function pdf_iframe_init(parent, parent_id)
{
    var slug = location.pathname.split('/').slice(1);

    if (slug[0] == "english-easy-read-pdf" || slug[0] == "english-professional-pdf" || slug[0] == "welsh-easy-read-pdf" || slug[0] == "welsh-professional-pdf")
    {
        parent.setAttribute("style", "border: 1px solid #CCC !important;");
        //console.log("pdfjs: applying border");
    }

    waitForEle('.toolbar', parent).then((ele) =>
    {
        if (slug[0] == "english-easy-read-pdf" || slug[0] == "english-professional-pdf" || slug[0] == "welsh-easy-read-pdf" || slug[0] == "welsh-professional-pdf")
        {
            parent.contentWindow.document.getElementById("toolbarViewerRight").style.display = "none";
            //console.log("pdfjs: disabling toolbar viewer right");
        }
        else
        {
            parent.contentWindow.document.getElementById("toolbarViewerRight").style.display = "none";
            parent.contentWindow.document.getElementById("toolbarContainer").style.display = "none";
            ele.style.display = "none";
            //console.log("pdfjs: disabling toolbar & toolbar viewer right");
        }

        waitForEle('#viewerContainer', parent).then((ele2) =>
        {
            ele2.style.top = 0;

            waitForEle('.pdfViewer', parent).then((ele3) =>
            {
                ele3.style.backgroundColor = "white";

                waitForEle('.pdfViewer .page', parent).then((ele4) =>
                {
                    ele4.style.border = 0;
                    ele4.style.padding = 0;
                    
                    waitForEle('#viewerContainer', parent).then((ele5) =>
                    {
                        ele5.style.backgroundColor = "white";

                        var link = document.createElement('link');
                        
                        link.rel = "stylesheet";
                        link.type = "text/css";

                        if (slug[0] == "english-easy-read-pdf" || slug[0] == "english-professional-pdf" || slug[0] == "welsh-easy-read-pdf" || slug[0] == "welsh-professional-pdf")
                        {
                            link.href = "https://splossary.wales/wp-content/themes/wp-wsspr-theme/library/css/iframe-doc.css";
                        }
                        else link.href = "https://splossary.wales/wp-content/themes/wp-wsspr-theme/library/css/iframe.css";

                        var doc = document.getElementsByClassName(parent_id)[0].contentWindow.document.head;
                        doc.append(link);

                        setTimeout(function() { legacy_uri_correction(parent); }, 125);
                        setTimeout(function() { legacy_uri_correction(parent); }, 250);
                        setTimeout(function() { legacy_uri_correction(parent); }, 500);
                        setTimeout(function() { legacy_uri_correction(parent); }, 1000);
                        setTimeout(function() { legacy_uri_correction(parent); }, 2000);
                        setTimeout(function() { legacy_uri_correction(parent); }, 4000);
                    });
                });
            });
        });
    });
}

if (iframe)
{
    iframe.onload = function()
    {
        pdf_iframe_init(iframe, "pdfjs-viewer");
        pdf_iframe_init(iframe, "pdfjs-viewer");
    };
}

if (iframe_legacy)
{
    iframe_legacy.onload = function()
    {
        pdf_iframe_init(iframe_legacy, "pdfjs-iframe");
        pdf_iframe_init(iframe_legacy, "pdfjs-iframe");
    };
}


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