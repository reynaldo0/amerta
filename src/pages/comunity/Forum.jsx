import React, { useState, useEffect } from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faReply, faThumbsUp } from "@fortawesome/free-solid-svg-icons";
import AOS from "aos";
import "aos/dist/aos.css";

export default function ForumSection() {
  const [posts, setPosts] = useState([
    {
      id: 1,
      author: "Andi",
      content: "Budaya gotong royong harus selalu kita jaga agar tetap hidup.",
      likes: 3,
      replies: [
        {
          id: 1,
          author: "Budi",
          content: "Setuju banget! Itu ciri khas kita.",
          likes: 1,
        },
      ],
    },
  ]);
  const [newPost, setNewPost] = useState("");
  const [replyContent, setReplyContent] = useState({});
  const [showReplyBox, setShowReplyBox] = useState(null);

  useEffect(() => {
    AOS.init({ duration: 1000, once: true });
  }, []);

  const addPost = () => {
    if (!newPost.trim()) return;
    setPosts([
      ...posts,
      {
        id: posts.length + 1,
        author: "Guest",
        content: newPost,
        likes: 0,
        replies: [],
      },
    ]);
    setNewPost("");
  };

  const addReply = (postId) => {
    if (!replyContent[postId]?.trim()) return;
    setPosts(
      posts.map((post) =>
        post.id === postId
          ? {
              ...post,
              replies: [
                ...post.replies,
                {
                  id: post.replies.length + 1,
                  author: "Guest",
                  content: replyContent[postId],
                  likes: 0,
                },
              ],
            }
          : post
      )
    );
    setReplyContent({ ...replyContent, [postId]: "" });
    setShowReplyBox(null);
  };

  const addLike = (postId, replyId = null) => {
    setPosts(
      posts.map((post) => {
        if (post.id === postId) {
          if (replyId === null) return { ...post, likes: post.likes + 1 };
          return {
            ...post,
            replies: post.replies.map((r) =>
              r.id === replyId ? { ...r, likes: r.likes + 1 } : r
            ),
          };
        }
        return post;
      })
    );
  };

  return (
    <section className="relative bg-white py-24 min-h-screen">
      <div
        className="absolute inset-0 bg-[url('/wave/komunitas.png')] bg-cover bg-center opacity-10"
        style={{ backgroundAttachment: "fixed" }}
      />
      <div className="max-w-5xl mx-auto relative z-10">
        <h2
          data-aos="fade-up"
          className="text-3xl md:text-4xl font-bold text-center mb-8 text-primary-200"
        >
          Forum Diskusi Budaya
        </h2>

        {/* Form Komentar */}
        <div
          data-aos="fade-up"
          data-aos-delay="200"
          className="bg-white shadow-xl rounded-3xl p-6 mb-8 border border-gray-200"
        >
          <textarea
            className="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-secondary-300 outline-none bg-white"
            rows="3"
            placeholder="Tulis pendapatmu..."
            value={newPost}
            onChange={(e) => setNewPost(e.target.value)}
          />
          <button
            onClick={addPost}
            className="mt-4 px-6 py-2 bg-secondary-300 text-white rounded-xl hover:bg-secondary-400 transition-all shadow-md cursor-pointer"
          >
            Kirim
          </button>
        </div>

        {/* List Diskusi */}
        <div className="space-y-6">
          {posts.map((post, i) => (
            <div
              key={post.id}
              data-aos="zoom-in"
              data-aos-delay={i * 100}
              className="bg-white shadow-lg rounded-3xl p-6 transition-transform duration-300 hover:scale-[1.02] border border-gray-200"
            >
              <div className="flex items-center gap-3 mb-2">
                <img
                  src={`https://ui-avatars.com/api/?name=${post.author}`}
                  alt={post.author}
                  className="w-10 h-10 rounded-full"
                />
                <span className="font-semibold text-primary-200">
                  {post.author}
                </span>
                <button
                  onClick={() => addLike(post.id)}
                  className="ml-auto flex items-center gap-1 text-sm text-secondary-300 hover:text-secondary-400 transition cursor-pointer"
                >
                  <FontAwesomeIcon icon={faThumbsUp} /> {post.likes}
                </button>
              </div>
              <p className="text-gray-700 mb-3">{post.content}</p>

              {/* tombol reply */}
              <button
                onClick={() =>
                  setShowReplyBox(showReplyBox === post.id ? null : post.id)
                }
                className="text-sm cursor-pointer text-secondary-300 hover:underline flex items-center gap-2"
              >
                <FontAwesomeIcon icon={faReply} /> Balas
              </button>

              {/* Balasan */}
              <div className="ml-10 mt-4 space-y-4 border-l-2 border-secondary-200 pl-4">
                {post.replies.map((reply) => (
                  <div
                    key={reply.id}
                    data-aos="fade-left"
                    className="bg-white p-3 rounded-xl transition-transform hover:scale-[1.02] border"
                  >
                    <div className="flex items-center gap-2 mb-1">
                      <img
                        src={`https://ui-avatars.com/api/?name=${reply.author}`}
                        alt={reply.author}
                        className="w-8 h-8 rounded-full"
                      />
                      <span className="text-sm font-medium text-primary-200">
                        {reply.author}
                      </span>
                      <button
                        onClick={() => addLike(post.id, reply.id)}
                        className="ml-auto flex items-center gap-1 text-xs text-secondary-300 hover:text-secondary-400 transition cursor-pointer"
                      >
                        <FontAwesomeIcon icon={faThumbsUp} /> {reply.likes}
                      </button>
                    </div>
                    <p className="text-gray-600 text-sm">{reply.content}</p>
                  </div>
                ))}
              </div>

              {/* Input balasan */}
              {showReplyBox === post.id && (
                <div data-aos="fade-up" className="mt-4 ml-10">
                  <textarea
                    className="w-full border rounded-xl p-2 text-sm focus:ring-2 focus:ring-secondary-300 outline-none bg-white"
                    rows="2"
                    placeholder="Tulis balasanmu..."
                    value={replyContent[post.id] || ""}
                    onChange={(e) =>
                      setReplyContent({
                        ...replyContent,
                        [post.id]: e.target.value,
                      })
                    }
                  />
                  <button
                    onClick={() => addReply(post.id)}
                    className="mt-2 px-4 py-1 bg-secondary-300 text-white text-sm rounded-lg hover:bg-secondary-400 transition shadow-md cursor-pointer"
                  >
                    Kirim Balasan
                  </button>
                </div>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
