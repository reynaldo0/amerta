// TeamSection.jsx
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faGithub,
  faLinkedinIn,
  faInstagram,
} from "@fortawesome/free-brands-svg-icons";

const team = [
  {
    name: "Bekhyun Aditya",
    role: "Leader, Illustrator, Data Analyst",
    image: "/team/adit.jpeg",
    github: "https://github.com/",
    linkedin: "https://linkedin.com/",
    instagram: "https://instagram.com/",
  },
  {
    name: "Reynaldo Yusellino",
    role: "Creative Designer, Frontend Developer",
    image: "/team/aldo.png",
    github: "https://github.com/reynaldo0",
    linkedin: "https://linkedin.com/reynaldoyusellino",
    instagram: "https://instagram.com/rynldysllino",
  },
  {
    name: "Naufal Aqil Nasrullah",
    role: "Backend Developer",
    image: "/team/aqil.png",
    github: "https://github.com/",
    linkedin: "https://linkedin.com/",
    instagram: "https://instagram.com/",
  },
];

export default function TeamSection() {
  return (
    <section className="min-h-screen flex relative items-center justify-center bg-white py-16">
      <div
        className="absolute inset-0 bg-[url('/wave/about.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-6xl mx-auto px-6 text-center">
        <h2 className="text-3xl md:text-4xl font-extrabold mb-14 text-primary-200">
          Tim Amerta
        </h2>

        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
          {team.map((member, idx) => (
            <div
              key={idx}
              className="group relative bg-white/70 backdrop-blur-lg border border-gray-200 p-8 rounded-2xl shadow-lg hover:shadow-2xl hover:-translate-y-2 transform transition-all duration-300"
            >
              {/* Foto */}
              <div className="relative w-32 h-32 mx-auto overflow-hidden rounded-full border-2 border-secondary-300 shadow-md group-hover:scale-110 transform transition duration-300">
                <img
                  src={member.image}
                  alt={member.name}
                  className="w-full h-full object-cover"
                />
              </div>

              {/* Nama & Role */}
              <h3 className="mt-6 text-lg font-semibold text-gray-900 group-hover:text-secondary-300 transition">
                {member.name}
              </h3>
              <p className="text-sm text-gray-500">{member.role}</p>

              {/* Sosial Media */}
              <div className="flex justify-center gap-6 mt-6">
                <a
                  href={member.github}
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={`${member.name} GitHub`}
                  className="text-gray-600 hover:text-gray-900 hover:scale-125 transition transform duration-200"
                >
                  <FontAwesomeIcon icon={faGithub} size="lg" />
                </a>

                <a
                  href={member.linkedin}
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={`${member.name} LinkedIn`}
                  className="text-gray-600 hover:text-blue-600 hover:scale-125 transition transform duration-200"
                >
                  <FontAwesomeIcon icon={faLinkedinIn} size="lg" />
                </a>

                <a
                  href={member.instagram}
                  target="_blank"
                  rel="noopener noreferrer"
                  aria-label={`${member.name} Instagram`}
                  className="text-gray-600 hover:text-pink-500 hover:scale-125 transition transform duration-200"
                >
                  <FontAwesomeIcon icon={faInstagram} size="lg" />
                </a>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
