-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 26, 2025 at 10:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `decentReads`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL,
  `author_name` varchar(50) NOT NULL,
  `about_the_author` varchar(4000) DEFAULT NULL,
  `author_handle` varchar(50) DEFAULT NULL,
  `author_birth_place` varchar(200) NOT NULL,
  `author_personal_site` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `about_the_author`, `author_handle`, `author_birth_place`, `author_personal_site`) VALUES
(1, 'Stephen King', 'Stephen Edwin King was born the second son of Donald and Nellie Ruth Pillsbury King. After his father left them when Stephen was two, he and his older brother, David, were raised by his mother. Parts of his childhood were spent in Fort Wayne, Indiana, where his father\'s family was at the time, and in Stratford, Connecticut. When Stephen was eleven, his mother brought her children back to Durham, Maine, for good. Her parents, Guy and Nellie Pillsbury, had become incapacitated with old age, and Ruth King was persuaded by her sisters to take over the physical care of them. Other family members provided a small house in Durham and financial support. After Stephen\'s grandparents passed away, Mrs. King found work in the kitchens of Pineland, a nearby residential facility for the mentally challenged.\r\n\r\nStephen attended the grammar school in Durham and Lisbon Falls High School, graduating in 1966. From his sophomore year at the University of Maine at Orono, he wrote a weekly column for the school newspaper, THE MAINE CAMPUS. He was also active in student politics, serving as a member of the Student Senate. He came to support the anti-war movement on the Orono campus, arriving at his stance from a conservative view that the war in Vietnam was unconstitutional. He graduated in 1970, with a B.A. in English and qualified to teach on the high school level. A draft board examination immediately post-graduation found him 4-F on grounds of high blood pressure, limited vision, flat feet, and punctured eardrums.\r\n\r\nHe met Tabitha Spruce in the stacks of the Fogler Library at the University, where they both worked as students; they married in January of 1971. As Stephen was unable to find placement as a teacher immediately, the Kings lived on his earnings as a laborer at an industrial laundry, and her student loan and savings, with an occasional boost from a short story sale to men\'s magazines.\r\n\r\nStephen made his first professional short story sale (\"The Glass Floor\") to Startling Mystery Stories in 1967. Throughout the early years of his marriage, he continued to sell stories to men\'s magazines. Many were gathered into the Night Shift collection or appeared in other anthologies.\r\n\r\nIn the fall of 1971, Stephen began teaching English at Hampden Academy, the public high school in Hampden, Maine. Writing in the evenings and on the weekends, he continued to produce short stories and to work on novels.', '@sking', 'Portland, Maine, The US', 'stephenKing.com'),
(2, 'Tessonja Odette', 'Tessonja Odette is a Seattle-based author of fantasy romance, epic romantasy, and fairytale retellings. She especially loves to write about brooding fae and the fierce women who hate-to-love them. When she isn’t writing, she’s watching cat videos, petting dogs, having dance parties in the kitchen with her daughter, or pursuing her many creative hobbies. In her books, you\'ll find enemies-to-lovers, witty banter, cozy vibes, and a delicious dash of steam.', '@todette', 'Somewhere in the US', 'http://tessonjaodette.com/'),
(3, 'Emily Shore', 'Emily used to be the good little church-going girl who snuck peeks of smutty romance at the bookstore. Now, she proudly writes smut and has forsaken the religious cult of her past. Emily includes a trauma-healing theme loosely based on her own experiences in all her work.\r\n\r\nIn 2020, Emily found her voice while writing dark fantasy romance. In 2021, she rebranded on Kindle Vella and has been a Vella bestseller for two years. Her writing always features enemies to lovers with heroines who don\'t need a sword to be strong, monsters and villains with \"burn the world for her\" vibes, and trauma healing.\r\n\r\nEmily\'s bestselling books on Kindle Vella include: The Sacrifice, Bride of Lucifer, Bride of the Corpse King, Courting Death and Destruction, and Grymm Beauty. Learn more at “Emily’s Vella Verse” on FB or connect with her on social media to learn how you can become a super fan and get super fan treats!\r\n\r\nAn abuse survivor and trained advocate, Emily has worked as an awareness speaker all over Minnesota. Identifying as bisexual and feminist, she loves to showcase sex and kink positivity and normalized LGBTQIA+ inclusivity.\r\n\r\nWhen not writing enemies to lovers, Emily is addicted to the Enneagram, rewatching Schitts Creek, cuddling with her kitty, and spending time with her online sisterhood where she can exercise her big empath heart. She lives in Saint Paul with her husband and two daughters—one is a budding author.', '@emilyShore', 'Somewhere in the US', 'http://www.emilybethshore.com/');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `brief_synops` varchar(4000) NOT NULL,
  `author_id` int(50) NOT NULL,
  `published_date` date DEFAULT NULL,
  `number_of_pages` int(11) NOT NULL,
  `avg_rating` decimal(10,0) DEFAULT NULL,
  `number_of_reviews` int(11) DEFAULT NULL,
  `number_of_ratings` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_title`, `brief_synops`, `author_id`, `published_date`, `number_of_pages`, `avg_rating`, `number_of_reviews`, `number_of_ratings`) VALUES
(1, 'The Stand', 'First came the days of the plague. Then came the dreams. Dark dreams that warned of the coming of the dark man. The apostate of death, his worn-down boot heels tramping the night roads. The warlord of the charnel house and Prince of Evil. His time is at hand. His empire grows in the west and the Apocalypse looms.\r\nFor hundreds of thousands of fans who read The Stand in its original version and wanted more, this new edition is Stephen King\'s gift. And those who are listening to The Stand for the first time will discover a triumphant and eerily plausible work of the imagination that takes on the issues that will determine our survival.', 1, '1978-10-03', 1153, NULL, NULL, NULL),
(2, 'Salem\'s Lot', 'Thousands of miles away from the small township of \'Salem\'s Lot, two terrified people, a man and a boy, still share the secrets of those clapboard houses and tree-lined streets. They must return to \'Salem\'s Lot for a final confrontation with the unspeakable evil that lives on in the town.', 1, '1975-10-17', 439, NULL, NULL, NULL),
(3, 'My Feral Romance', 'A painter in need of a model.\r\nA matchmaker seeking a subject.\r\nAn arrangement that will tangle their hearts.\r\n\r\nFae shifter Daphne has landed the opportunity of a illustrating her favorite author’s steamy romance novels. If only she could master male physiques…and other essential anatomy. What she needs is a model. Yet how does the socially awkward fae with a tendency to bite find a man she can comfortably paint in the nude?\r\n\r\nSelf-proclaimed matchmaker Monty Phillips is a hopeless romantic, but only when it comes to others. Meddling in the love lives of strangers via his popular advice column keeps romance a safe distance away. Yet when he’s tasked with proving his tips on modern courtship work, he’ll need to step out from behind the pen and into someone’s love life.\r\n\r\nAnd he knows just the perfect plaything.\r\n\r\nThe last time Daphne saw Monty, he broke her heart and discarded their friendship. Now he wants to drag her into one of his idiotic matchmaking games—where she’s the subject! But when he promises to pose as her model in exchange, she can’t refuse. At least it’s only temporary. If he’s the expert he claims to be, she can replace him with a lover in no time.\r\n\r\nPainting sessions and flirting lessons commence, rekindling their friendship. But when instructional seduction turns their platonic spark into burning desire, will either have the courage to fan the flames?\r\n\r\nBridgerton meets My Fair Lady and a dash of He’s Just Not That Into You in My Feral Romance , a spicy standalone fantasy romcom in the Fae Flings and Corset Strings series. If you like fae bargains, friends-to-lovers romance, and cozy fantasy worlds, you’ll love this sizzling tale.', 2, '2024-12-10', 416, NULL, NULL, NULL),
(4, 'Kidnapped By Krampus', 'Tis the season for spice...and a little Krampus magic!\r\n\r\nIs Krampus real?\r\n\r\nTWYLA\r\n\r\nThat\'s the question burning in my investigative journalist mind as I sneak into Krampus World to learn the truth about the eccentric CEO who always wears the monstrous holiday costume. I\'m definitely making the naughty list for this.\r\n\r\nAfter sharing a drink with the mysterious and quiet CEO, the last thing I expect is waking up with no clothes in the most beautiful winter castle. This horned heartthrob billionaire kidnapped me!\r\n\r\nDespite the language barrier, I soon learn that his punishments are hot enough to melt the North Pole. And there are far worse things than being treated like a Christmas princess in a Yuletide-themed castle.\r\n\r\nAs I unwrap the layers of this hooved and horned enigma, I suspect the monster may be as real as Rudolph\'s red nose! And I might be falling for him faster than Santa coming down the chimney.\r\n\r\nWell.... Monster romance is trending after all!\r\n\r\nKRAMPUS\r\n\r\nDon’t show them your tongue.\r\nDon’t growl.\r\nDon’t urge them to check your body for some nonexistent zipper.\r\nDon’t wag your tail.\r\nDon\'t show them how well you dance in hooves.\r\n\r\nAfter a century of failures to find true love, Twyla is my last chance to break the curse before the clock runs out. I will do whatever it takes to keep my little star, my light in the darkness. It turns out this naughty girl may love my monstrous punishments and the magic of my realm.\r\n\r\nIt\'s not long before Twyla tangles around my heart more than twinkle lights. But can she believe a monster is her happily ever after? Will she save me from my icy fate?\r\n\r\nOr am I doomed to be the demon of Yuletide with a frozen heart forever?\r\n\r\nFrom bestselling author Emily Shore comes a romantasy that will give you all those Hallmark feels with a sack full of spicy surprises. A Christmas kidnapping never felt so dark and enchanting—or so cozy. Get ready for a rollercoaster sleigh ride that\'ll have you believing in holiday miracles and a mischievous monster you\'ll be dying to get under the mistletoe!', 3, '2023-11-13', 150, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books_lists`
--

CREATE TABLE `books_lists` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `books_tags`
--

CREATE TABLE `books_tags` (
  `tag_rel_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books_tags`
--

INSERT INTO `books_tags` (`tag_rel_id`, `book_id`, `tag_id`) VALUES
(28, 3, 3),
(29, 3, 14),
(30, 3, 10),
(31, 2, 1),
(32, 2, 11),
(33, 2, 4),
(34, 1, 1),
(35, 1, 17),
(36, 4, 18),
(37, 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `book_review_id` int(11) NOT NULL,
  `book_review_created` datetime NOT NULL DEFAULT current_timestamp(),
  `book_review_user_id` int(50) NOT NULL,
  `book_review_score` decimal(10,0) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_review_title` varchar(100) NOT NULL,
  `book_review_content` varchar(4000) NOT NULL,
  `number_of_likes` int(11) DEFAULT NULL,
  `complete_or_dnf` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`book_review_id`, `book_review_created`, `book_review_user_id`, `book_review_score`, `book_id`, `book_review_title`, `book_review_content`, `number_of_likes`, `complete_or_dnf`) VALUES
(2, '2024-12-23 15:30:06', 2, 3, 3, 'Liked it, Didn\'t love it', 'Update: It was good, but I didn\'t feel the magic I had with the 1st.\r\n\r\nHAPPY RELEASE DAY! (I\'m just a *lot* upset it\'s not about the sister... but it is fully my fault for being oblivious) Hey y\'all it\'s me Christene', NULL, 'Completed it'),
(6, '2024-12-26 11:18:26', 1, 3, 2, 'Vampires', 'Mauris finibus varius sem, ut vehicula turpis vestibulum eu. Vestibulum sed justo ut lacus maximus laoreet. In in nunc id urna hendrerit euismod in viverra nunc. Ut cursus justo pretium elit mattis gravida. Proin elementum eu dolor non consectetur. Ut a ornare velit. Fusce facilisis eros ante, eu sollicitudin nisl maximus eu. Nulla eu augue et orci volutpat tristique. Aliquam ultricies ullamcorper imperdiet. Quisque ut efficitur justo. Nam fermentum purus sapien, non mollis libero luctus id. Etiam in suscipit turpis. Etiam vehicula porttitor condimentum. Cras placerat purus sit amet gravida rhoncus. Fusce pretium turpis leo, ut lacinia velit pretium nec.\r\n\r\nNam vitae purus eget lorem viverra aliquam vel eget felis. Donec volutpat tempor nibh a placerat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tempus risus id ultrices ultrices. Morbi nisi risus, tempus quis blandit ut, rutrum at lectus. Proin in tincidunt eros. Praesent pharetra, lorem vel eleifend efficitur, ex magna laoreet diam, vitae aliquam leo neque quis ante. Mauris posuere ligula arcu, eget lobortis orci molestie sit amet.\r\n\r\nNulla venenatis odio nibh, sed varius felis hendrerit sit amet. In finibus metus ut scelerisque sodales. Vivamus bibendum semper elit non finibus. Donec et magna dolor. Vivamus ac sagittis est. Aliquam eget laoreet magna, vitae ultrices odio. Nulla fermentum diam a lectus commodo, et pretium elit sagittis. Vivamus at feugiat elit. Nunc sollicitudin urna dui, ac mollis purus eleifend at. Phasellus fermentum libero ac lectus viverra pulvinar.\r\n\r\nCras aliquet sodales magna non finibus. Nulla pretium urna in enim faucibus posuere. Nam dolor lorem, tempor nec pellentesque et, gravida non dolor. Nam id dapibus massa. Praesent a lectus sem. Nam sed felis purus. Duis eu quam in mi auctor tincidunt. Suspendisse nec nulla sit amet velit scelerisque finibus at ac ex. Vivamus sapien ante, vehicula rutrum feugiat non, eleifend sed nisl. Sed viverra, nibh vitae porttitor posuere, nisi lacus feugiat eros, id vehicula ante dolor eu ex. Integer ut neque vel tortor efficitur venenatis. Nulla facilisi. Aenean ut porta erat.', NULL, 'Completed it'),
(7, '2024-12-30 11:31:53', 1, 2, 3, 'Couldn\'t get into it', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras varius lectus non ipsum aliquet mattis. Nullam luctus non orci sed consequat. Vivamus ac scelerisque odio, eleifend ultrices nisi. Curabitur auctor vulputate quam, vel tincidunt purus sagittis sed. Suspendisse nec orci sit amet ipsum molestie euismod. Phasellus et tempus turpis. Donec quis nunc in erat sodales volutpat a ac diam. Integer ullamcorper sagittis vehicula. Suspendisse a ante molestie, auctor ipsum sit amet, lobortis magna. Donec mattis eleifend nisl non laoreet. Quisque ac sapien purus. Etiam sollicitudin ante eros, eu elementum enim porta sit amet.\r\n\r\nUt semper tellus eu tellus varius rhoncus. Donec posuere eleifend dui et fermentum. Mauris lobortis ex eu varius rhoncus. Nam posuere urna id facilisis vestibulum. Proin id auctor nisi. Nunc congue elit ut arcu facilisis posuere. Quisque faucibus ac libero faucibus lacinia. Nam malesuada vehicula neque at laoreet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean diam sapien, iaculis nec elementum vitae, vulputate eu enim. Nam quis gravida nibh.\r\n\r\nSuspendisse feugiat, erat non finibus fringilla, est ante pellentesque ligula, ut ullamcorper velit velit eget odio. In sit amet arcu sapien. Aliquam finibus, justo sed luctus lobortis, ex orci tincidunt nisi, vitae accumsan lectus eros at ante. In hac habitasse platea dictumst. Proin quis tellus eget erat facilisis semper a ac mauris. Pellentesque molestie rhoncus arcu, non maximus leo congue in. Maecenas in posuere tortor, vel dapibus odio. Praesent vel lacus hendrerit, hendrerit ex ac, commodo ipsum. Aliquam hendrerit quam lectus, at volutpat lectus elementum ut. Phasellus hendrerit ipsum libero, in condimentum mi consequat at. Etiam tempor risus nec ipsum viverra dignissim. Morbi tempus, est congue sagittis elementum, felis dui hendrerit turpis, nec malesuada ipsum risus quis tellus. Aenean ac arcu eget nisl tempus ullamcorper. F', NULL, 'DNF'),
(8, '2024-12-30 11:46:20', 2, 2, 4, 'Needs more plot', 'It’s a very fine line between erotica and 🍇 fantasy, and unfortunately this crossed the line. Especially since the first sex scene was him spiking her drink with magic and her passing out even though she was totally down for anything… Just felt that was a bit unnecessary.\r\n\r\nAlso, the plot was nonexistent and the sex itself was very overwritten to the point where it started to drag and got annoying. 🫣😬 And why did she keep passing out? Homegirl needed her blood pressure checked', NULL, 'Completed it');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_content` varchar(2000) NOT NULL,
  `author` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `comment_content`, `author`, `created`) VALUES
(2, 6, 'This is a comment', '1', '2024-12-27 09:31:27'),
(4, 6, 'hello again', '1', '2024-12-27 09:56:38'),
(6, 2, 'This is a comment', '1', '2024-12-30 11:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(20) NOT NULL,
  `author` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created`, `type`, `author`) VALUES
(0, 'Hitting a reading slump', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada mauris at enim sagittis, vel tincidunt odio lacinia. In vitae lectus elit. Maecenas fringilla purus at arcu lacinia laoreet. Quisque sed molestie turpis. Fusce eu nisi ac eros facilisis auctor sed euismod dui. Quisque aliquam enim vel magna feugiat, sit amet gravida leo tristique. Sed malesuada mauris non dui tincidunt luctus..\r\n\r\nSed tincidunt ligula a nisi commodo, ac pellentesque libero suscipit. Aliquam in tellus q', '2024-12-23 20:18:52', 'post', 'Justin Dreher');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_title`) VALUES
(1, 'Horror'),
(3, 'Sapphic'),
(4, 'Gothic'),
(10, 'Romance'),
(11, 'Vampires'),
(13, 'Bromance'),
(14, 'Pure Filth'),
(17, 'Post-Apocalyptic'),
(18, 'Holiday');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_full_name` varchar(100) NOT NULL,
  `user_f_name` varchar(50) NOT NULL,
  `user_l_name` varchar(50) DEFAULT NULL,
  `user_pw` varchar(100) NOT NULL,
  `user_un` varchar(100) NOT NULL,
  `user_role` varchar(100) NOT NULL DEFAULT 'user',
  `preferred_pronoun` varchar(30) DEFAULT NULL,
  `user_bio` varchar(4000) DEFAULT NULL,
  `user_location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_full_name`, `user_f_name`, `user_l_name`, `user_pw`, `user_un`, `user_role`, `preferred_pronoun`, `user_bio`, `user_location`) VALUES
(1, 'Justin Dreher', 'Justin', 'Dreher', 'admin', 'jdawg', 'admin', 'He/Him', 'Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I\'m in a transitional period so I don\'t wanna kill you, I wanna help you. But I can\'t give you this case, it don\'t belong to me. Besides, I\'ve already been through too much shit this morning over this case to hand it over to your dumb ass. ', 'Tampa Bay Area'),
(2, 'Darian Spears', 'Darian', 'Spears', 'tucker', 'lovedpirate', 'user', 'She/Her', 'Nashville clock masters Hot 100 CD Taylah tour film red lipstick tour Joe Anti-Hero Haim easter egg Willow you need to calm down i had a marvelous time ruining everything casette snow on the beach betty reputation Fearless Anti-Hero the last great american dynasty masters folklore song rock deluxe surprise critics critics Nashville Fearless you need to calm down i had a marvelous time ruining everything tour bonus snow on the beach New York Cardigan Taylor 22 deluxe song blondie co-writer Anti-Hero masters snow on the beach i had a marvelous time ruining everything Aaron Dressner Lover Hot 100 Grammy Long Pong Sessions soft New York London mezzo-soprano tour Long Pong Sessions cottagecore vocalist my tears ricochet rollout Eras Tour Blank Space music video exile twang here\'s how Cruel Summer can still be a single (Taylor\'s Version) guitar signer sexy baby tour film presale the 1 fame Shake it Off (Taylor\'s Version) stadium surprise folklore CD glitter gel pen snake I swear I don\'t love the drama, it loves me CD Target Exclusive', 'Upstate NY');

-- --------------------------------------------------------

--
-- Table structure for table `user_lists`
--

CREATE TABLE `user_lists` (
  `list_id` int(11) NOT NULL,
  `list_name` varchar(50) NOT NULL,
  `list_desc` varchar(1000) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_lists`
--

INSERT INTO `user_lists` (`list_id`, `list_name`, `list_desc`, `user_id`) VALUES
(1, 'Read', 'Books I\'ve finished', 1),
(2, 'DNF', 'Books I could not finish', 1),
(3, 'Loved Books', 'Books I really liked, and would probably re-read', 1),
(4, 'Recomended books', 'Books that were recommended to me by either social media or a person irl', 1),
(5, 'Read', 'Books I\'ve completed', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `books_lists`
--
ALTER TABLE `books_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_tags`
--
ALTER TABLE `books_tags`
  ADD PRIMARY KEY (`tag_rel_id`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD PRIMARY KEY (`book_review_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_lists`
--
ALTER TABLE `user_lists`
  ADD PRIMARY KEY (`list_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `books_lists`
--
ALTER TABLE `books_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `books_tags`
--
ALTER TABLE `books_tags`
  MODIFY `tag_rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `book_reviews`
--
ALTER TABLE `book_reviews`
  MODIFY `book_review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_lists`
--
ALTER TABLE `user_lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
