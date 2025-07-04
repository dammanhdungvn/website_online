const quizTimer = document.querySelector("#timer");
const quizProgress = document.querySelector("#progress");
const quizProgressText = document.querySelector("#progress_text");
const quizSubmit = document.querySelector("#quiz_submit");

const quizPrev = document.querySelector("#quiz_prev");
const quizNext = document.querySelector("#quiz_next");
const quizCount = document.querySelector(".quiz_question h5");
const quizAnswers = document.querySelectorAll(".quiz_question ul li");
let quizQuestions = document.querySelectorAll(".quiz_numbers ul li");
const quizQuestionList = document.querySelector(".quiz_numbers ul");
const quizAnswersItem = document.querySelectorAll(".quiz_answer_item");
const quizTitle = document.querySelector("#quiz_title"); 
var score;

fetch(url)
  .then((response) => {
    // Check if the response is successful
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json(); // Parse the response as JSON
  })
  .then((data) => {
    // Do something with the parsed JSON data
    let questions = data.questions;
    const results = data.correct_answers;

    // ________QUIZ_APP________________
    let currentIndex = null;
    let listSubmit = []; // Lưu index đáp án đã chọn
    let listResults = []; // Lưu index kết quả đúng, theo mảng đã random
    let isSubmit = false;
    function randomArray(array) {
      return (array = array.sort(() => Math.random() - Math.random()));
    }
    const quiz = {
      randomQuestions: function () {
        questions = randomArray(questions);
        questions.forEach((q) => {
          q.answers = randomArray(q.answers);
        });
      },
      renderQuestionList: function () {
        let render = "";
        questions.forEach((question, index) => {
          render += `<li>${index + 1}</li>`;
        });
        quizQuestionList.innerHTML = render;
        quizQuestions = document.querySelectorAll(".quiz_numbers ul li");
      },
      renderCurrentQuestion: function () {
        quizCount.innerText = `Question ${currentIndex + 1} of ${
          questions.length
        }`;
        quizTitle.innerText = questions[currentIndex].question;
        quizAnswersItem.forEach((answer, index) => {
          answer.innerText = questions[currentIndex].answers[index];
        });
      },
      renderProgress: function () {
        quizProgress.style = `stroke-dasharray: 0 9999;`;
        quizProgressText.innerText = `0/${questions.length}`;
      },
      renderTimer: function () {
        timer = timer * 60;
        let _this = this;
        // Lấy thẻ p có id là "timer"
        var countdownElement = document.getElementById("timer");

        // Hàm cập nhật thời gian
        function updateTimer() {
          var minutes = Math.floor(timer / 60);
          var seconds = timer % 60;

          // Định dạng thời gian thành chuỗi HH:MM:SS
          var timerString =
            (minutes < 10 ? "0" : "") +
            minutes +
            ":" +
            (seconds < 10 ? "0" : "") +
            seconds;

          // Gán thời gian đã định dạng vào thẻ p
          countdownElement.innerHTML = timerString;

          // Giảm thời gian mỗi giây
          timer--;
          // Kiểm tra nếu hết thời gian
          if (timer < 0) {
            countdownElement.innerHTML = "Hết thời gian!";
            _this.handleCheckResults();
          }
          if (isSubmit) {
            clearInterval(intervalId);
          }
        }

        // Gọi hàm updateTimer mỗi giây
        var intervalId = setInterval(updateTimer, 1000);
      },
      renderResults: function () {
        if (listResults[currentIndex] === listSubmit[currentIndex]) {
          quizAnswers.forEach((item) => {
            item.classList.remove("incorrect");
          });
          quizAnswers[listResults[currentIndex]].classList.add("active");
        } else {
          quizAnswers.forEach((item) => {
            item.classList.remove("active");
            item.classList.remove("incorrect");
          });
          quizAnswers[listResults[currentIndex]].classList.add("active");
          quizAnswers[listSubmit[currentIndex]].classList.add("incorrect");
        }
      },
      handleProgress: function (correct) {
        const r = quizProgress.getAttribute("r");
        if (!isSubmit) {
          const progressLen = listSubmit.filter((item) => item >= 0);
          quizProgress.style = `stroke-dasharray: ${
            (2 * Math.PI * r * progressLen.length) / questions.length
          } 9999;`;
          quizProgressText.innerText = `${progressLen.length}/${questions.length}`;

        } else {
          quizProgress.style = `stroke-dasharray: ${
            (2 * Math.PI * r * correct) / questions.length
          } 9999;`;
          quizProgressText.innerText = `${correct}/${questions.length}`;
        }
      },
      handleQuestionList: function () {
        quizQuestions.forEach((item, index) => {
          item.addEventListener("click", () => {
            item.scrollIntoView({
              behavior: "smooth",
              inline: "center",
            });
            quizQuestions.forEach((item) => item.classList.remove("active"));
            item.classList.add("active");
            currentIndex = index;
            this.renderCurrentQuestion();
            quizAnswers.forEach((item) => item.classList.remove("active"));
            const selected = listSubmit[currentIndex];
            selected >= 0 && quizAnswers[selected].click();
            if (isSubmit) {
              this.renderResults();
            }
          });
        });
        quizQuestions[0].click();
      },
      handleAnswer: function () {
        quizAnswers.forEach((answer, index) => {
          answer.addEventListener("click", () => {
            if (!isSubmit) {
              quizAnswers.forEach((item) => item.classList.remove("active"));
              answer.classList.add("active");
              quizQuestions[currentIndex].classList.add("selected");
              listSubmit[currentIndex] = index;
              this.handleProgress();
            } else {
              return;
            }
          });
        });
      },
      handleNext: function () {
        quizNext.addEventListener("click", () => {
          ++currentIndex;
          if (currentIndex > questions.length - 1) {
            currentIndex = 0;
          }
          quizQuestions[currentIndex].click();
        });
      },
      handlePrev: function () {
        quizPrev.addEventListener("click", () => {
          --currentIndex;
          if (currentIndex < 0) {
            currentIndex = questions.length - 1;
          }
          quizQuestions[currentIndex].click();
        });
      },
      handleSubmit: function () {
        quizSubmit.addEventListener("click", () => {
          const progressLen = listSubmit.filter((item) => item >= 0);
          if (progressLen.length === questions.length) {
            this.handleCheckResults();
            
            // Kỹ thuật  AJAX gửi dữ liệu qua cho PHP nhận điểm
            fetch('?module=home&action=save_score', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({ score: score })
            })
            .then(response => response.text())
            .then(data => {
              console.log(data); // Xử lý kết quả từ PHP
            });


          } else {
            alert("Bạn chưa chọn hết đáp án");
          }
        });
      },
      handleCheckResults: function () {
        let correct = 0;
        questions.forEach((item, index) => {
          const result = results.find((r) => r.quiz_id === item.quiz_id);
          if (item.answers[listSubmit[index]] === result.answer) {
            listResults[index] = listSubmit[index];
            correct++;
          } else {
            quizQuestions[index].classList.add("incorrect");
            listResults[index] = item.answers.indexOf(result.answer);
          }
        });
        isSubmit = true;
        score = correct;
        this.handleProgress(correct);
      },
      handleKeyDown: function () {
        document.addEventListener("keydown", (e) => {
          switch (e.key) {
            case "ArrowRight":
              return quizNext.click();
            case "ArrowLeft":
              return quizPrev.click();
            default:
              return false;
          }
        });
      },
      render: function () {
        this.renderQuestionList();
        this.renderProgress();
        this.renderTimer();
      },
      handle: function () {
        this.handleQuestionList();
        this.handleAnswer();
        this.handleNext();
        this.handlePrev();
        this.handleKeyDown();
        this.handleSubmit();
      },
      start: function () {
        this.randomQuestions();
        this.render();
        this.handle();
      },
    };

    quiz.start();
  })
  .catch((error) => {
    // Handle any errors that occurred during the fetch or parsing
    console.error("Lỗi đồng bộ:", error);
  });


