import { useParams, Link } from "react-router-dom";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faUser,
  faCalendarAlt,
  faLandmark,
  faArrowLeft,
  faShareAlt,
} from "@fortawesome/free-solid-svg-icons";
import { articles } from "../../docs/articlesData";

export default function ArticleDetailBudaya() {
  const { id } = useParams();
  const article = articles.find((a) => a.id === parseInt(id));

  if (!article) {
    return (
      <p className="text-center text-gray-500">Artikel tidak ditemukan.</p>
    );
  }

  return (
    <div className="bg-white relative min-h-screen">
      <div
        className="absolute inset-0 bg-[url('/wave/budaya.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      {/* Hero Section */}
      <div className="relative w-full h-72 md:h-96 overflow-hidden">
        <img
          src={article.image}
          alt={article.title}
          className="w-full h-full object-cover"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-black/80 to-black/20 flex items-end p-6 md:p-12">
          <h1 className="text-3xl md:text-5xl font-bold text-white drop-shadow-xl">
            {article.title}
          </h1>
        </div>
      </div>

      {/* Content Section */}
      <section className="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">
        <article className="lg:col-span-2 bg-white/90 backdrop-blur-md rounded-2xl shadow-lg p-8">
          <div className="flex flex-wrap items-center text-sm text-gray-600 gap-4 mb-6">
            <span className="flex items-center gap-2">
              <FontAwesomeIcon icon={faUser} /> {article.author}
            </span>
            <span className="flex items-center gap-2">
              <FontAwesomeIcon icon={faCalendarAlt} /> {article.date}
            </span>
            <span className="flex items-center gap-2">
              <FontAwesomeIcon icon={faLandmark} /> {article.category}
            </span>
          </div>

          <div className="prose max-w-none text-gray-700 leading-relaxed">
            {article.content.split("\n").map((para, idx) => (
              <p key={idx} className="mb-4">
                {para}
              </p>
            ))}
          </div>

          <div className="mt-10 flex items-center gap-4">
            <button className="flex items-center gap-2 px-4 py-2 bg-amber-600 text-white rounded-lg shadow hover:bg-amber-700 transition">
              <FontAwesomeIcon icon={faShareAlt} /> Bagikan
            </button>
            <Link
              to="/artikel"
              className="flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg shadow hover:bg-gray-200 transition"
            >
              <FontAwesomeIcon icon={faArrowLeft} /> Kembali
            </Link>
          </div>
        </article>

        <aside className="space-y-6">
          <div className="bg-white/90 backdrop-blur-md rounded-2xl shadow-md p-6">
            <h3 className="font-semibold text-lg mb-4 text-amber-700">
              Artikel Budaya Lainnya
            </h3>
            <ul className="space-y-3">
              {articles
                .filter((a) => a.id !== article.id)
                .map((a) => (
                  <Link
                    key={a.id}
                    to={`/artikel/${a.id}`}
                    className="block p-3 rounded-lg hover:bg-amber-50 transition"
                  >
                    <p className="text-sm font-medium text-gray-800">
                      {a.title}
                    </p>
                    <span className="text-xs text-gray-500">{a.date}</span>
                  </Link>
                ))}
            </ul>
          </div>
        </aside>
      </section>
    </div>
  );
}
