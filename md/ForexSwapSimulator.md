# Forex Swap Simulator

#form
  dl
    dt
      label(for="priceFrom") Price From
    dd
      input#priceFrom(value="100")
  dl
    dt
      label(for="priceTo") Price To
    dd
      input#priceTo(value="100")
  dl
    dt
      label(for="dateFrom") Date From
    dd
      input#dateFrom(type="date")
  dl
    dt
      label(for="dateTo") Date To
    dd
      input#dateTo(type="date")
  dl
    dt
      label(for="capital") Capital with a 1:1 Leverage
    dd
      input#capital(value="1000000")
  dl
    dt
      label(for="leverage") Leverage
    dd
      input#leverage(value="10")
  dl
    dt
      label(for="swap") Swap Point Per 10,000 Currency Unit
    dd
      input#swap(value="10")
  dl
    dt
      label Position
    dd
      input#long(type="radio"name="position"value="long"checked="checked")
      label(for="long") Long
      input#short(type="radio"name="position"value="short")
      label(for="short") Short
  button#calc Calculation

h2#result Result
dl
  dt Currency Unit
  dd#resCurrencyUnit
dl
  dt Swap Point Gain
  dd#resSwap
dl
  dt Capital Gain
  dd#resCapital
dl
  dt Total Gain
  dd#resTotal

script
  $$(window).on('load', function(){
    $$('#calc').on('click', function(){
      var diffPrice = Number( $$('#priceTo').val() ) - Number( $$('#priceFrom').val() );
      var diffDate = ($$('#dateTo')[0].valueAsNumber - $$('#dateFrom')[0].valueAsNumber) / 86400000;
      var capitalUnit = parseInt( Number( $$('#capital').val() ) * Number( $$('#leverage').val() ) / Number( $$('#priceFrom').val() ) );
      var swap = Number( $$('#swap').val() ) / 10000;
      var position = $$('#short').prop('checked') ? -1 : 1;
      var resSwap = parseInt( capitalUnit * diffDate * swap );
      var resCapital = parseInt( capitalUnit * diffPrice * position );
      var resTotal = resSwap + resCapital;

      $$('#resCurrencyUnit').text( capitalUnit );
      $$('#resSwap').text( resSwap );
      $$('#resCapital').text( resCapital );
      $$('#resTotal').text( resTotal );
    });
  });

