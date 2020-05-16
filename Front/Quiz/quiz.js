        var numQues = 5;
        var numChoi = 3;

        function getScore(form) {
            var currElt;
            var currSelection;
            var contor = 0;
            for (i = 0; i < numQues; i++) {
                currElt = i * numChoi;
                answered = false;
                for (j = 0; j < numChoi; j++) {
                    currSelection = form.elements[currElt + j];
                    if (currSelection.checked) {
                        answered = true;
                        contor++;
                    }
                }
                if (answered === false) {
                    alert("Do answer all the questions, Please");
                    return false;
                }
            }
        }