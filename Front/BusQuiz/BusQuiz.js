var numQues = 5;
    var numChoi = 3;
    var answers = new Array(15);
    answers[0] = "doesn't like";
    answers[1] = "don't come";
    answers[2] = "come";
    answers[3] = "don't";
    answers[4] = "doesn't make";
    function getScore(form) {
        var score = 0;
        var currElt;
        var currSelection;
        for (i = 0; i < numQues; i++) {
            currElt = i * numChoi;
            answered = false;
            for (j = 0; j < numChoi; j++) {
                currSelection = form.elements[currElt + j];
                if (currSelection.checked) {
                    answered = true;
                    if (currSelection.value == answers[i]) {
                        score++;
                        break;
                    }
                }
            }
            if (answered === false) {
                alert("Do answer all the questions, Please");
                return false;
            }
        }
        var scoreper = Math.round(score / numQues * 100);
        form.percentage.value = scoreper + "%";
        form.mark.value = score;
    }