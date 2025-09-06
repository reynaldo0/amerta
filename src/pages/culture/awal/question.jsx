import { useState, useRef, useEffect } from "react";
import Star from "/illustrasi/star.svg"; // Pastikan path benar
import Cross from "/illustrasi/salah.svg"; // Atau buat ikon khusus untuk 0 skor
import questions from "../../../docs/questionData";

const Questions = ({ goBack }) => {
  const [current, setCurrent] = useState(0);
  const [selected, setSelected] = useState(null);
  const [answers, setAnswers] = useState([]);
  const [score, setScore] = useState(0);
  const [showResult, setShowResult] = useState(false);
  const [animationClass, setAnimationClass] = useState("slide-in-left");

  const correctSound = useRef(null);
  const wrongSound = useRef(null);
  const resultSound = useRef(null);

  useEffect(() => {
    if (showResult && resultSound.current) {
      resultSound.current.currentTime = 0;
      resultSound.current.play();
    }
  }, [showResult]);

  const handleAnswer = (index) => {
    if (selected !== null) return;

    setSelected(index);
    const correct = questions[current].answer;
    const isCorrect = index === correct;

    setAnswers([...answers, index]);

    if (isCorrect) {
      correctSound.current.currentTime = 0;
      correctSound.current.play();
      setScore((prev) => prev + 10);
    } else {
      wrongSound.current.currentTime = 0;
      wrongSound.current.play();
    }

    setTimeout(() => {
      if (current < questions.length - 1) {
        setAnimationClass("slide-out-left");
        setTimeout(() => {
          setCurrent(current + 1);
          setSelected(null);
          setAnimationClass("slide-in-left");
        }, 300);
      } else {
        setShowResult(true);
      }
    }, 2000);
  };

  const resetQuiz = () => {
    setCurrent(0);
    setSelected(null);
    setAnswers([]);
    setScore(0);
    setShowResult(false);
    setAnimationClass("slide-in-left");
  };

  const progressPercent = ((current + 1) / questions.length) * 100;

  const getStars = () => {
    if (score >= 90) return 3;
    if (score >= 70) return 2;
    if (score >= 40) return 1;
    return 0;
  };

  const getEvaluation = () => {
    if (score >= 90)
      return "Luar biasa! Kamu sangat menguasai budaya di Indonesia!";
    if (score >= 70) return "Bagus! Kamu cukup paham tentang budaya Indonesia.";
    if (score >= 40)
      return "Masih perlu belajar lebih banyak tentang budaya Indonesia.";
    return "Wah, sepertinya kamu perlu mencoba lagi!";
  };

  return (
    <>
      {/* Audio elements */}
      <audio ref={correctSound} src="/sound/benar.mp3" />
      <audio ref={wrongSound} src="/sound/salah.mp3" />
      <audio ref={resultSound} src="/sound/score.mp3" />

      <section className="min-h-screen justify-center relative bg-cover bg-center">
        <div
          className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
          style={{ backgroundAttachment: "fixed" }}
        />
        <div className="max-w-5xl pt-28 md:pt-32 mx-auto p-4 relative z-10">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-primary-200 mb-6">
            Kuis Budaya Nusantara
          </h1>
          {/* Tombol Kembali */}
          <button
            onClick={goBack}
            className="mb-4 px-4 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition"
          >
            ← Kembali
          </button>

          {/* Progress bar */}
          <div className="w-full h-3 mb-4 rounded-full border-2 border-black bg-white overflow-hidden">
            <div
              className="h-full bg-secondary-200 transition-all duration-300"
              style={{ width: `${progressPercent}%` }}
            />
          </div>

          {/* Soal */}
          <div
            className={`bg-primary-200 text-white p-8 rounded-3xl shadow-md ${animationClass}`}
          >
            <p className="text-sm mb-2">
              Pertanyaan {current + 1}/{questions.length}
            </p>
            <h2 className="text-2xl font-semibold mb-4">
              {questions[current].question}
            </h2>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
              {questions[current].options.map((option, index) => {
                const isCorrect = index === questions[current].answer;
                const isSelected = selected === index;

                let buttonClass =
                  "w-full py-3 px-4 rounded-xl font-medium text-left transition flex justify-between items-center";

                if (selected !== null) {
                  if (isCorrect) {
                    buttonClass +=
                      " bg-green-100 outline outline-blue-500 text-black";
                  } else if (isSelected && !isCorrect) {
                    buttonClass += " bg-red-200 text-black";
                  } else {
                    buttonClass += " bg-secondary-200 text-black";
                  }
                } else {
                  buttonClass +=
                    " bg-secondary-200 hover:bg-secondary-200/90 text-black";
                }

                return (
                  <button
                    key={index}
                    onClick={() => handleAnswer(index)}
                    disabled={selected !== null}
                    className={buttonClass}
                  >
                    <span>
                      {String.fromCharCode(65 + index)}. {option}
                    </span>
                    {isCorrect && selected !== null && (
                      <img
                        src="/illustrasi/ceklis.svg"
                        alt="Benar"
                        width={20}
                      />
                    )}
                    {selected !== null && isSelected && !isCorrect && (
                      <img src="/illustrasi/salah.svg" alt="Salah" width={20} />
                    )}
                  </button>
                );
              })}
            </div>
          </div>

          {/* Modal hasil */}
          {showResult && (
            <div className="fixed inset-0 bg-black/30 backdrop-blur-sm flex items-center justify-center z-50">
              <div className="bg-white rounded-3xl p-10 max-w-xl w-full text-center shadow-lg fade-in-up">
                <h2 className="text-3xl font-bold text-primary-200 mb-6">
                  Kuis Selesai!
                </h2>

                {/* Bintang */}
                <div className="flex justify-center gap-2 mb-4">
                  {getStars() > 0 ? (
                    [...Array(getStars())].map((_, i) => (
                      <img
                        key={i}
                        src={Star}
                        alt="star"
                        className="w-20 h-20 animate-bounce"
                        style={{ animationDelay: `${i * 0.2}s` }}
                      />
                    ))
                  ) : (
                    <img src={Cross} alt="no-star" className="w-20 h-20" />
                  )}
                </div>

                <p className="text-xl text-gray-800 mb-2">
                  Skor kamu: <span className="font-bold">{score}</span> dari{" "}
                  {questions.length * 10}
                </p>
                <p className="text-md text-gray-600 italic mb-6">
                  {getEvaluation()}
                </p>

                <div className="flex flex-col md:flex-row gap-4 justify-center">
                  <button
                    onClick={() => setShowResult(false)}
                    className="text-lg px-14 py-3 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition"
                  >
                    Tutup
                  </button>
                  <button
                    onClick={resetQuiz}
                    className="text-lg px-14 py-3 bg-secondary-200 text-black rounded-xl hover:bg-secondary-200/80 transition"
                  >
                    Ulangi Kuis
                  </button>
                </div>
              </div>
            </div>
          )}
        </div>
      </section>
    </>
  );
};

export default Questions;
