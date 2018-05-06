# Deep Learning Simulator of Only 1 Neuron

.row
  .sp12.pc-gold-s
    ### Learning data
    table
      tr
        th input1
        th input2
        th output
        th learn
      tr
        td 0
        td 0
        td
          select#output0
            option(value="0" selected="selected") 0
            option(value="1") 1
        td [input(type="radio" name="learn" value="0" disabled="disabled" checked="checked")]
      tr
        td 0
        td 1
        td
          select#output1
            option(value="0" selected="selected") 0
            option(value="1") 1
        td [input(type="radio" name="learn" value="1" disabled="disabled")]
      tr
        td 1
        td 0
        td
          select#output2
            option(value="0" selected="selected") 0
            option(value="1") 1
        td [input(type="radio" name="learn" value="2" disabled="disabled")]
      tr
        td 1
        td 1
        td
          select#output3
            option(value="0") 0
            option(value="1" selected="selected") 1
        td [input(type="radio" name="learn" value="3" disabled="disabled")]

    label Learning order
      input(type="radio" name="order" value="auto" checked="checked") Auto
      input(type="radio" name="order" value="manual") Manual

    button#learn.*mt10 LEARN

  .sp12.pc-gold-l.*relative
    ### Learn
    .*w80.*absolute Input layer
      .*w80.*h50.*center.*bd#ccc 
        div Input1
        #learn_input0 0
      .*w80.*h50.*center.*bd#ccc.*mt10
        div Input2
        #learn_input1 0
      .*w80.*h50.*center.*bd#ccc.*mt10
        div Threshold
        #learn_input2 -1.0
    .*w130.*l80.*absolute Hidden layer
      .*w100.*center.*bd#ccc
        div 0 * [span#neuron0]
        div +
        div 0 * [span] [span#neuron1]
        div +
        div -1.0 * [span#neuron2()]

.pc12.sp12
  ### Neuron status
  div Input1
    #neuron0
  div Input2
    #neuron1
  div Threshold
    #neuron2
  div Error
    #error

script
  var INPUT_NO = 2;
  var LEARNING_RATE = 1;
  var MAX_COUNT = 1;
  var INIT_ERROR = 100;
  var LIMIT_ERROR = 0.01;
  var INPUT_DATA = [
    [0, 0],
    [0, 1],
    [1, 0],
    [1, 1]
  ];
  var OUTPUT_DATA = [];
  var OUTPUT_NODES = [];
  var THRESHOLD = -1.0;

  function main(){
    //重みの初期化
    initOutputWeight();
    printWeight();
    console.log(OUTPUT_NODES);

    //学習データの読み込み
    getLearningData();

    count = 0;
    while(true){
      var error = 0.0;
      for(var row = 0; row < OUTPUT_DATA.length; row++){
        var output = forward(row);

        learnOutput(output, row);

        error = calcError(output, row);
        console.log(INPUT_DATA[row], error, output);
      }
      
      count++;
      if(error < LIMIT_ERROR) break;
      if(count > MAX_COUNT) break;
    }
    printWeight();

  }

  function getLearningData(){
    var i = 0;
    while(true){
      if($$('#output' + String(i)).length == 0){
        break;
      }
      OUTPUT_DATA.push($$('#output' + String(i)).val());
      i++;
    }
    return;
  }

  function forward(row){
    var output = 0;
    for(var column = 0; column < INPUT_NO; column++){
      output += OUTPUT_DATA[row] * OUTPUT_NODES[column];
    }
    output += OUTPUT_NODES[INPUT_NO] * THRESHOLD;
    return sigmoid(output);
  }

  function learnOutput(output, row){
    var error = (OUTPUT_DATA[row] - output) * output * (1 - output);
    for(var column = 0; column < INPUT_NO; column++){
      OUTPUT_NODES[column] += LEARNING_RATE * error * OUTPUT_DATA[row];
    }
    OUTPUT_NODES[INPUT_NO] += LEARNING_RATE * error * THRESHOLD;
  }

  function calcError(output, row){
    return Math.pow(output - OUTPUT_DATA[row], 2);
  }

  function printWeight(){
    var i = 0;
    while(true){
      if($$('#neuron' + String(i)).length == 0){
        break;
      }
      $$('#neuron' + String(i)).text(OUTPUT_NODES[i]);
      i++;
    }
    return;
  }

  function initOutputWeight(){
    for(var i = 0; i < INPUT_NO + 1; i++){
      OUTPUT_NODES[i] = rand();
    }
  }

  function sigmoid(x){
    return 1 / (1 + Math.pow(Math.E, -x));
  }

  function rand(){
    return Math.random();
  }

  $$(window).on('load', function(){
    main();
  });


  
