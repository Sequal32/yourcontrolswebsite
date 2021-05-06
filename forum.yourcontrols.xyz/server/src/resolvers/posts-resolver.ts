import { Repository } from 'typeorm';
import { InjectRepository } from 'typeorm-typedi-extensions';
import { Resolver, Query, Authorized, Arg } from 'type-graphql';
import { Post } from '../entities';

@Resolver(() => Post)
export class PostResolver {
    constructor(
        @InjectRepository(Post) private readonly postRepository: Repository<Post>
    ) {}
    @Authorized()
    @Query(() => [Post])
    posts(): Promise<Post[]> {
        return this.postRepository.find();
    }
    @Authorized()
    @Query(() => Post)
    post(@Arg("id") id: number): Promise<Post> {
        return this.postRepository.findOne(id);
    }
}
