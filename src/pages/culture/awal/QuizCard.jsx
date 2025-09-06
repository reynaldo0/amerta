import { useState, useEffect } from "react";
import axios from "axios";
import Questions from "./question";
import DefaultImage from "/illustrasi/wayang.png";

const QuizCardWrapper = () => {
  const [quizList, setQuizList] = useState([]);
  const [selectedQuiz, setSelectedQuiz] = useState(null);
  const [startQuiz, setStartQuiz] = useState(false);

  useEffect(() => {
    const fetchQuizzes = async () => {
      try {
        const res = await axios.get("http://localhost:8000/api/v1/quizzes");
        setQuizList(res.data.quizzes); // otomatis semua quiz
      } catch (err) {
        console.error("Gagal mengambil daftar quiz:", err);
      }
    };
    fetchQuizzes();
  }, []);

  if (!quizList.length) return null;

  return (
    <>
      {!startQuiz ? (
        <section className="min-h-screen flex flex-col items-center justify-center bg-gradient-to-b from-gray-100 to-gray-50 px-4">
          <div className="text-center mb-12 max-w-2xl">
            <h1 className="text-4xl md:text-5xl font-extrabold text-primary-200 mb-4">
              Selamat Datang di Kuis Budaya Nusantara
            </h1>
            <p className="text-gray-600 text-lg md:text-xl">
              Uji pengetahuanmu tentang budaya Indonesia. Pilih quiz yang ingin
              kamu ikuti.
            </p>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl">
            {quizList.map((quiz) => (
              <div
                key={quiz.id}
                onClick={() => {
                  setSelectedQuiz(quiz);
                  setStartQuiz(true);
                }}
                className="cursor-pointer bg-white rounded-3xl shadow-2xl overflow-hidden transform transition hover:scale-105 hover:shadow-3xl"
              >
                <div className="p-6 text-center">
                  <h2 className="text-2xl font-bold text-primary-200 mb-2">
                    {quiz.title || "Kuis Budaya Nusantara"}
                  </h2>
                  <p className="text-gray-600 mb-4">
                    {quiz.content_id.title ||
                      "Tes kemampuanmu dalam mengenal budaya, tradisi, dan sejarah Indonesia."}
                  </p>
                  <button className="bg-secondary-200 text-black font-semibold px-6 py-3 rounded-full hover:bg-secondary-300 transition">
                    Mulai Kuis
                  </button>
                </div>
              </div>
            ))}
          </div>
        </section>
      ) : (
        <Questions quizData={selectedQuiz} goBack={() => setStartQuiz(false)} />
      )}
    </>
  );
};

export default QuizCardWrapper;
