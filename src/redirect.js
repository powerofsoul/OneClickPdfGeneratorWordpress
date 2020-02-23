var addUrlParam = function(search, key, val){
    var newParam = key + '=' + val,
        params = '?' + newParam;
  
    if (search) {
      params = search.replace(new RegExp('([?&])' + key + '[^&]*'), '$1' + newParam);
      if (params === search) {
        params += '&' + newParam;
      }
    }
  
    return params;
  };

function OneClickPdfGeneratorLink()
{
    window.open(document.location.pathname + addUrlParam(document.location.search, "oneclickpdfgenerator", true));
}

