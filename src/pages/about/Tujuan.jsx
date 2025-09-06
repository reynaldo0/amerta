import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faBullseye,
  faLightbulb,
  faHandshake,
  faChartLine,
} from "@fortawesome/free-solid-svg-icons";

export default function TujuanSection() {
  const tujuan = [
    {
      icon: faBullseye,
      title: "Fokus Tujuan",
      desc: "Kami berkomitmen untuk mencapai target dengan strategi yang terarah dan efektif.",
    },
    {
      icon: faLightbulb,
      title: "Inovasi",
      desc: "Menciptakan ide-ide baru yang kreatif untuk meningkatkan kualitas dan daya saing.",
    },
    {
      icon: faHandshake,
      title: "Kolaborasi",
      desc: "Membangun kerja sama yang solid untuk mencapai hasil yang lebih baik.",
    },
    {
      icon: faChartLine,
      title: "Pertumbuhan",
      desc: "Mendorong perkembangan berkelanjutan dengan pendekatan modern dan dinamis.",
    },
  ];

  return (
    <section className="relative bg-primary-100 pt-24 px-6 overflow-hidden min-h-screen mx-auto">
      {/* Background Parallax */}
      <div
        className="absolute inset-0 bg-[url('/wave/aboutw.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-6xl mx-auto text-center relative z-10">
        <h2 className="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">
          Tujuan Kami
        </h2>
        <p className="text-lg text-gray-100 max-w-2xl mx-auto">
          Kami hadir dengan visi dan misi untuk memberikan dampak positif dan
          solusi terbaik melalui tujuan yang jelas.
        </p>
      </div>

      {/* Cards */}
      <div className="mt-16 grid md:grid-cols-2 lg:grid-cols-4 gap-10 max-w-6xl mx-auto relative z-10">
        {tujuan.map((item, index) => (
          <div
            key={index}
            className="group relative bg-white/70 backdrop-blur-lg p-8 rounded-3xl shadow-lg border border-white/30 hover:shadow-2xl transition-transform transform hover:-translate-y-2 duration-300"
          >
            {/* Icon */}
            <div className="flex items-center justify-center w-20 h-20 bg-gradient-to-tr from-secondary-200 via-secondary-300 to-secondary-200 text-white rounded-2xl mx-auto mb-6 shadow-md group-hover:scale-110 transition-transform duration-300">
              <FontAwesomeIcon icon={item.icon} size="2x" />
            </div>

            {/* Title */}
            <h3 className="text-xl text-gray-800 mb-3 group-hover:text-brown-600 transition-colors duration-300">
              {item.title}
            </h3>

            {/* Desc */}
            <p className="text-gray-600 text-sm leading-relaxed">{item.desc}</p>

          </div>
        ))}
      </div>
    </section>
  );
}
