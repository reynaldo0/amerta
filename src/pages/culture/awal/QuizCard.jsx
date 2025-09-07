import { useState, useEffect } from "react";
import Questions from "./question";
import DefaultImage from "/illustrasi/wayang.png";
import AOS from "aos";
import "aos/dist/aos.css";

const QuizCardWrapper = () => {
  const [quizList] = useState([
    {
      id: 1,
      title: "Kuis Budaya Nusantara",
      content_id: {
        title: "Tes pengetahuan tentang budaya Indonesia",
      },
      image: DefaultImage,
    },
    {
      id: 2,
      title: "Kuis Sejarah Indonesia",
      content_id: {
        title: "Seberapa jauh kamu paham tentang sejarah Indonesia?",
      },
      image: DefaultImage,
    },
    {
      id: 3,
      title: "Kuis Musik Tradisional",
      content_id: {
        title: "Kenali alat musik khas Nusantara",
      },
      image: DefaultImage,
    },
  ]);

  const [selectedQuiz, setSelectedQuiz] = useState(null);
  const [startQuiz, setStartQuiz] = useState(false);

  useEffect(() => {
    AOS.init({
      duration: 1000,
      once: true,
    });
  }, []);

  if (!quizList.length) return null;

  // variasi animasi
  const animations = [
    "fade-up",
    "fade-down",
    "zoom-in",
    "flip-left",
    "flip-right",
  ];

  return (
    <>
      {!startQuiz ? (
        <section className="min-h-screen flex relative flex-col items-center justify-center bg-white px-4">
          {/* Background */}
          <div
            className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
            style={{ backgroundAttachment: "fixed" }}
          />

          {/* Heading */}
          <div className="text-center mb-12 max-w-2xl" data-aos="fade-up">
            <h1 className="text-4xl md:text-5xl font-extrabold text-primary-200 mb-4">
              Selamat Datang di Kuis Budaya Nusantara
            </h1>
            <p className="text-gray-600 text-lg md:text-xl">
              Uji pengetahuanmu tentang budaya Indonesia. Pilih quiz yang ingin
              kamu ikuti.
            </p>
          </div>

          {/* Cards */}
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full max-w-6xl relative">
            {quizList.map((quiz, index) => (
              <div
                key={quiz.id}
                data-aos={animations[index % animations.length]} // variasi animasi
                onClick={() => {
                  setSelectedQuiz(quiz);
                  setStartQuiz(true);
                }}
                className="cursor-pointer bg-white rounded-3xl shadow-2xl overflow-hidden transform transition hover:scale-105 hover:shadow-3xl"
              >
                <div className="p-6 text-center">
                  <img
                    src={quiz.image}
                    alt={quiz.title}
                    className="w-32 h-32 mx-auto mb-4 object-contain"
                  />
                  <h2 className="text-2xl font-bold text-primary-200 mb-2">
                    {quiz.title}
                  </h2>
                  <p className="text-gray-600 mb-4">{quiz.content_id.title}</p>
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
