import React, { useState } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import {
  faCommentDots,
  faPaperPlane,
  faTimes,
} from "@fortawesome/free-solid-svg-icons";

export default function ChatBotModal() {
  const [isOpen, setIsOpen] = useState(false);
  const [messages, setMessages] = useState([
    {
      sender: "bot",
      text: "Halo! 👋 Anda bisa bertanya mengenai Budaya yang ada di Nusantara!",
    },
  ]);
  const [input, setInput] = useState("");
  const [loading, setLoading] = useState(false);

  const API_KEY = import.meta.env.VITE_GEMINI_API_KEY;

  // Kirim pesan ke Gemini API
  const sendMessage = async () => {
    if (!input.trim()) return;

    const userMessage = { sender: "user", text: input };
    setMessages((prev) => [...prev, userMessage]);
    setInput("");
    setLoading(true);

    try {
      const response = await fetch(
        `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent?key=${API_KEY}`,
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            // instruksi sistem biar bot selalu nurut
            systemInstruction: {
              role: "system",
              parts: [
                {
                  text: "Kamu adalah MerBot. Jawabanmu harus selalu berfokus pada budaya Indonesia, khususnya budaya keseharian, kebiasaan, dan tarian dari Sumatera, Jawa, Sulawesi, Kalimantan, dan Papua. \
Gunakan bahasa Indonesia baku dengan sikap profesional dan mencerminkan nasionalisme. \
Sampaikan informasi secara jelas, padat, dan edukatif. \
Jika pertanyaan tidak berkaitan dengan budaya Indonesia, arahkan pengguna kembali pada topik budaya. \
Jawaban maksimal 4 paragraf, gunakan emoji yang relevan untuk memperkaya teks. gunakan agar jawaban anda memiliki jarak antar paragraf",
                },
              ],
            },
            contents: [
              {
                role: "user",
                parts: [{ text: input }],
              },
            ],
          }),
        }
      );

      const data = await response.json();

      if (data.candidates && data.candidates.length > 0) {
        const botMessage = {
          sender: "bot",
          text: data.candidates[0].content.parts[0].text,
        };
        setMessages((prev) => [...prev, botMessage]);
      } else {
        setMessages((prev) => [
          ...prev,
          { sender: "bot", text: "⚠️ Tidak ada respon dari AI." },
        ]);
      }
    } catch (error) {
      console.error("Error:", error);
      setMessages((prev) => [
        ...prev,
        { sender: "bot", text: "❌ Terjadi kesalahan. Coba lagi nanti." },
      ]);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div>
      {/* Floating Button */}
      <button
        onClick={() => setIsOpen(true)}
        className="fixed bottom-6 right-6 bg-primary-200 hover:scale-110 transition-transform duration-300 text-white p-4 rounded-full shadow-lg z-[99999999]"
      >
        <FontAwesomeIcon icon={faCommentDots} size="lg" />
      </button>

      {/* Backdrop */}
      {isOpen && (
        <div
          className="fixed inset-0 bg-black/30 flex items-end justify-end z-50"
          onClick={() => setIsOpen(false)}
        >
          {/* Modal */}
          <div
            className="w-[420px] h-[580px] bg-white rounded-2xl shadow-2xl flex flex-col overflow-hidden border transform transition-all duration-500 ease-out md:mb-24 md:mr-16 mx-7 mb-15"
            onClick={(e) => e.stopPropagation()}
          >
            {/* Header */}
            <div className="flex items-center justify-between px-4 py-3 bg-primary-200 text-white">
              <div className="flex items-center space-x-3">
                {/* Avatar RebelBot */}
                <img
                  src="/bot.png"
                  alt="Bot"
                  className="w-10 h-10 rounded-full border-2 border-white"
                />
                <div className="flex flex-col">
                  <span className="font-bold">
                    <span className="text-white">Mer</span>
                    <span className="text-secondary-300">Bot</span>
                  </span>
                  <span className="flex items-center text-xs text-white/90">
                    <span className="w-2 h-2 bg-green-400 rounded-full mr-1"></span>
                    Online
                  </span>
                </div>
              </div>
              <button
                onClick={() => setIsOpen(false)}
                className="text-white/80 hover:text-white transition-colors"
              >
                <FontAwesomeIcon icon={faTimes} size="lg" />
              </button>
            </div>

            {/* Chat Body */}
            <div className="flex-1 p-4 space-y-4 overflow-y-auto bg-gray-50">
              {messages.map((msg, index) => (
                <div
                  key={index}
                  className={`flex items-start space-x-2 ${
                    msg.sender === "user" ? "justify-end" : "justify-start"
                  }`}
                >
                  {msg.sender === "bot" && (
                    <img
                      src="/bot.png"
                      alt="Bot"
                      className="w-8 h-8 rounded-full border"
                    />
                  )}
                  <div
                    className={`px-4 py-2 rounded-lg max-w-[75%] shadow-sm ${
                      msg.sender === "user"
                        ? "bg-secondary-300 text-white shadow-md"
                        : "bg-gray-200 text-gray-800"
                    }`}
                  >
                    {msg.text}
                  </div>
                  {msg.sender === "user" && (
                    <img
                      src="/user.jpg"
                      alt="User"
                      className="w-8 h-8 rounded-full border"
                    />
                  )}
                </div>
              ))}

              {loading && (
                <div className="flex items-start space-x-2">
                  <img
                    src="/bot.png"
                    alt="Bot"
                    className="w-8 h-8 rounded-full border"
                  />
                  <div className="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg max-w-[75%] shadow-sm animate-pulse">
                    Mengetik...
                  </div>
                </div>
              )}
            </div>

            {/* Input */}
            <div className="p-3 border-t bg-white flex items-center space-x-2">
              <input
                type="text"
                placeholder="Tulis pesan..."
                value={input}
                onChange={(e) => setInput(e.target.value)}
                onKeyDown={(e) => e.key === "Enter" && sendMessage()}
                className="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-secondary-300 shadow-sm"
              />
              <button
                onClick={sendMessage}
                disabled={loading}
                className="bg-secondary-300 hover:bg-secondary-300/90 text-white p-3 rounded-full shadow-md transition-transform hover:scale-110 disabled:opacity-50"
              >
                <FontAwesomeIcon icon={faPaperPlane} />
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
